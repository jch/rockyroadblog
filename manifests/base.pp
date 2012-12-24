#### Vagrant configuration
group { "puppet":
  ensure => "present",
}

File { owner => 0, group => 0, mode => 0644 }
file { '/etc/motd':
  content => "Welcome to your Vagrant-built virtual machine!
              Managed by Puppet.\n"
}

package { ['curl','vim']:
  ensure => latest
}

#### Wordpress configuration

# Installs Wordpress version and symlinks to it
# $name or $path - symlink file to create
# $version       - a valid wordpress tag. e.g. 3.5
define wordpress::code(
  $version,
  $path = undef
) {

  $symlink = $path ? {
    undef   => $name,
    default => $path
  }
  $target = "/opt/wordpress-$version"

  vcsrepo { $target:
    ensure     => present,
    provider   => svn,
    source     => "http://core.svn.wordpress.org/tags/$version"
  }

  file { $symlink:
    target => $target
  }
}

$site_path = "/var/www/$fqdn"

wordpress::code { $site_path:
  version => '3.5'
}

file { "$site_path/wp-config.php":
  content => template("wordpress/wp-config.php")
}

# Theme
file { "$site_path/wp-content/themes/rockyroad":
   ensure => 'link',
   target => '/vagrant/theme',
}

# Uploads
file { "$site_path/wp-content/uploads":
    ensure => "directory",
    owner  => "root",
    group  => "root",
    mode   => 777,
}

# Plugins
file { "$site_path/wp-content/plugins/ylsy_permalink_redirect.php":
   ensure => 'link',
   target => '/vagrant/plugins/ylsy_permalink_redirect.php',
}

# Apache configuration
package { "apache2": ensure => present }

file { "vhost":
  path    => "/etc/apache2/sites-available/$fqdn",
  content => template("apache2/vhost.erb"),
  notify      => Service["apache2"];
}

exec {
  "a2ensite $fqdn":
    command     => "/usr/sbin/a2ensite $fqdn",
    creates     => "/etc/apache2/sites-enabled/$fqdn",
    notify      => Service["apache2"];
  "a2enmod rewrite":
    command     => "/usr/sbin/a2enmod rewrite",
    creates     => "/etc/apache2/mods-enabled/rewrite.load",
    notify      => Service["apache2"];
}

service {
  "apache2":
    ensure     => running,
    enable     => true,
    hasrestart => true,
    hasstatus  => true,
    require    => Package["apache2", "php5-mysql", "libapache2-mod-php5"],
}

# PHP configuration
package { ["php5-mysql", "libapache2-mod-php5"]:
  ensure => present
}

# MySQL configuration
package { ["mysql-client", "mysql-server"]:
  ensure => present
}

service {
  "mysql":
    ensure => running,
    enable      => true,
    hasrestart  => true,
    hasstatus   => true,
    require     => Package[ "mysql-client", "mysql-server" ],
}

exec {
  'create_schema':
    path     => '/usr/bin:/usr/sbin:/bin',
    command  => 'mysql -uroot -e "create database wordpress;"',
    unless   => 'mysql -uroot -e "use wordpress"',
    notify   => Exec['grant_privileges'],
    require  => Service["mysql"];
  'grant_privileges':
    path         => '/usr/bin:/usr/sbin:/bin',
    command      => "mysql -uroot -e \"grant all privileges on\
                    wordpress.* to\
                    'wordpress'@'localhost'\
                    identified by 'wordpress'\"",
    unless       => "mysql -uwordpress -pwordpress -Dwordpress -hlocalhost",
    refreshonly  => true;
}