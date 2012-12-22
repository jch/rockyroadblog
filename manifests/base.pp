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