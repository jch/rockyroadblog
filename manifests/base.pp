#### Vagrant configuration
group { "puppet":
  ensure => "present",
}

File { owner => 0, group => 0, mode => 0644 }
file { '/etc/motd':
  content => "Welcome to your Vagrant-built virtual machine!
              Managed by Puppet.\n"
}

#### Update apt cache before installing any packages
class apt {
  exec { "apt-update":
    command => "/usr/bin/apt-get update"
  }

  # Ensure apt-get update has been run before installing any packages
  Exec["apt-update"] -> Package <| |>
}
include apt

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

  package { "subversion": ensure => latest }

  exec { "svn-checkout":
    command => "/usr/bin/svn export http://core.svn.wordpress.org/tags/$version $target",
    creates => $target,
    require => Package["subversion"];
  }

  file { $symlink:
    ensure  => link,
    target  => $target,
    require => Exec["svn-checkout"]
  }
}

$site_path = "/var/www/$fqdn"

wordpress::code { $site_path:
  version => '3.5',
  notify  => Service["apache2"]
}

file { "$site_path/wp-config.php":
  content => template("wordpress/wp-config.php.erb")
}

# Theme
file { "$site_path/wp-content/themes/rockyroad":
   ensure => 'link',
   target => '/vagrant/theme',
   require => Wordpress::Code[$site_path]
}

# Uploads
file { "$site_path/wp-content/uploads":
    ensure => "directory",
    owner  => "root",
    group  => "root",
    mode   => 777,
    require => Wordpress::Code[$site_path]
}

# Plugins
file { "$site_path/wp-content/plugins/ylsy_permalink_redirect.php":
   ensure => 'link',
   target => '/vagrant/plugins/ylsy_permalink_redirect.php',
   require => Wordpress::Code[$site_path]
}

# Apache configuration
package { "apache2": ensure => present }

file { "vhost":
  path    => "/etc/apache2/sites-available/$fqdn",
  content => template("apache2/vhost.erb"),
  require => Package["apache2"],
  notify  => Service["apache2"];
}

file { "/etc/apache2/sites-enabled/000-default":
  ensure => absent,
  notify => Service["apache2"];
}

exec {
  "a2ensite $fqdn":
    command     => "/usr/sbin/a2ensite $fqdn",
    creates     => "/etc/apache2/sites-enabled/$fqdn",
    require     => Package["apache2"],
    notify      => Service["apache2"];
  "a2enmod rewrite":
    command     => "/usr/sbin/a2enmod rewrite",
    creates     => "/etc/apache2/mods-enabled/rewrite.load",
    require     => Package["apache2"],
    notify      => Service["apache2"];
}

service {
  "apache2":
    ensure     => running,
    enable     => true,
    hasrestart => true,
    restart    => '/usr/sbin/service apache2 restart',
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