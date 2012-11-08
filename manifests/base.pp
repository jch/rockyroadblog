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