# Wordpress theme for car blog

This theme is a work is progress for [RockyRoadBlog](http://rockyroadblog.com)

## Development

Follow the instructions for installing [Vagrant](http://vagrantup.com/)

```sh
$ script/bootstrap
$ open 'http://rockyroadblog.vagrant'
```

[vagrant-dns](https://github.com/BerlinVagrant/vagrant-dns) is run locally on
port 5300 to route requests to the VM. From within the VM, you can sync the
local database to the production database by running:

```sh
$ vagrant ssh
$ /vagrant/script/db-pull
```

## Deployment

To deploy the site, run:

```sh
$ rake deploy
```

This rsync this theme files over to the server.

## Files

* index.php - main wordpress page
* style.css - theme definition file
* functions.php - shared theme functionality, registration of hooks
* meta.php - author byline
* sidebar.php
* comments.php - disqus comments
* header.php, footer.php - shared header/footer

* sass - source stylesheets, compiled to css into 'stylesheets'

## Notes

* http://codex.wordpress.org/Function_Reference/
* http://codex.wordpress.org/Template_Tags
* [How to write excerpts](http://op111.net/67/)
* [Splitting Content - The more tag](http://en.support.wordpress.com/splitting-content/more-tag/)
* http://wordpress.org/support/topic/the-post-object
* http://justintadlock.com/archives/2009/11/16/everything-you-need-to-know-about-wordpress-2-9s-post-image-feature
* DONT have blank lines at end of functions.php - it'll insert a blank line in feeds, and break your feeds