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