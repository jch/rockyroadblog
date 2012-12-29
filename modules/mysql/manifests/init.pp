class mysql {
  package { ["mysql-client", "mysql-server"]:
    ensure => latest
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
}