class common {
  File { owner => 0, group => 0, mode => 0644 }

  group { 'puppet':
    ensure => 'present',
  }

  package { ['curl','vim']:
    ensure => latest
  }
}