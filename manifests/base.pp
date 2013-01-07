include common
include vagrant
include apt
include apache2
include php
include mysql

#### Wordpress configuration

$site_path = "/var/www/$fqdn"

wordpress::code { $site_path:
  version => '3.5',
  notify  => Service["apache2"]
}

file { "$site_path/wp-config.php":
  content => template('wordpress/wp-config.php.erb')
}

# Theme
file { "$site_path/wp-content/themes/rockyroad":
  ensure => 'link',
  target => '/vagrant/theme',
  require => Wordpress::Code[$site_path]
}

# Uploads
file { "$site_path/wp-content/uploads":
  ensure => 'directory',
  owner  => 'root',
  group  => 'root',
  mode   => 777,
  require => Wordpress::Code[$site_path]
}

# .htaccess
file { "$site_path/.htaccess":
  content => template('wordpress/htaccess.erb')
}

# Plugins
file { "$site_path/wp-content/plugins/ylsy_permalink_redirect.php":
  ensure => 'link',
  target => '/vagrant/plugins/ylsy_permalink_redirect.php',
  require => Wordpress::Code[$site_path]
}