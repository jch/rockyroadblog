# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|
  config.vm.box = "base"

  config.dns.tld = "vagrant"

  config.vm.host_name = "rockyroadblog.vagrant"

  config.dns.patterns = [/^.*rockyroadblog.vagrant$/]

  config.vm.network :hostonly, "33.33.33.60"

  # Forward a port from the guest to the host, which allows for outside
  # computers to access the VM, whereas host only networking does not.
  config.vm.forward_port 80, 8080

  # Enable provisioning with Puppet stand alone.  Puppet manifests
  # are contained in a directory path relative to this Vagrantfile.
  config.vm.provision :puppet do |puppet|
    puppet.module_path    = "modules"
    puppet.manifests_path = "manifests"
    puppet.manifest_file  = "base.pp"
  end
end
