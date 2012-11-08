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
   target => '/vagrant',
}

# Wordpress uploads
file { "/opt/wordpress/wp-content/uploads":
    ensure => "directory",
    owner  => "root",
    group  => "root",
    mode   => 777,
}