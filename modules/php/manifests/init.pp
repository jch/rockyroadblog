class php {
  package { ["php5-mysql", "libapache2-mod-php5"]:
    ensure => latest
  }
}