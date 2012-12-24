group { "puppet":
  ensure => "present",
}

File { owner => 0, group => 0, mode => 0644 }
file { '/etc/motd':
  content => "Welcome to your Vagrant-built virtual machine!
              Managed by Puppet.\n"
}

# include nginx
# nginx::resource::vhost { 'rockyroadblog.com':
#   ensure   => present,
#   www_root => '/var/www/rockyroadblog.com',
# }
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

include wordpress

file { '/opt/wordpress/wp-content/themes/rockyroad':
   ensure => 'link',
   target => '/vagrant/theme',
}

# Wordpress uploads
file { "/opt/wordpress/wp-content/uploads":
    ensure => "directory",
    owner  => "root",
    group  => "root",
    mode   => 777,
}

# Turn on Apache rewrites for permalinks
exec { '/usr/sbin/a2enmod rewrite': }
exec { '/usr/sbin/service apache2 restart': }

# Wordpress plugins
file { '/opt/wordpress/wp-content/plugins/ylsy_permalink_redirect.php':
   ensure => 'link',
   target => '/vagrant/plugins/ylsy_permalink_redirect.php',
}


package { "curl": }
package { "vim": }