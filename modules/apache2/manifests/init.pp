class apache2 {
  package { 'apache2': ensure => latest }

  file { 'vhost':
    path    => "/etc/apache2/sites-available/$fqdn",
    content => template('apache2/vhost.erb'),
    require => Package['apache2'],
    notify  => Service['apache2'];
  }

  # Remove apache2 default vhost b/c it doesn't work w/ custom tld domains.
  file { '/etc/apache2/sites-enabled/000-default':
    ensure => absent,
    notify => Service['apache2'];
  }

  exec {
    "a2ensite $fqdn":
      command     => "/usr/sbin/a2ensite $fqdn",
      creates     => "/etc/apache2/sites-enabled/$fqdn",
      require     => Package['apache2'],
      notify      => Service['apache2'];
    'a2enmod rewrite':
      command     => '/usr/sbin/a2enmod rewrite',
      creates     => '/etc/apache2/mods-enabled/rewrite.load',
      require     => Package['apache2'],
      notify      => Service['apache2'];
  }

  service {
    'apache2':
      ensure     => running,
      enable     => true,
      hasrestart => true,
      restart    => '/usr/sbin/service apache2 restart',
      hasstatus  => true,
      require    => Package['apache2', 'php5-mysql', 'libapache2-mod-php5'],
  }
}