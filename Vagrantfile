# encoding: utf-8
# -*- mode: ruby -*-
# vi: set ft=ruby :
require 'yaml'
current_dir    = File.dirname(File.expand_path(__FILE__))
configs        = YAML.load_file("#{current_dir}/config.yml")
vagrant_config = configs['configs']
Vagrant.require_version ">= #{vagrant_config['vagrant_required_version']}"
Vagrant.configure("2") do |config|
    config.vm.provider :virtualbox do |v|
        v.name = vagrant_config['displayname']
        v.customize ["modifyvm", :id, "--memory", vagrant_config['vagrant_memory_size']]
    end
    config.vm.box = vagrant_config['box']
    config.vm.network :private_network, ip: vagrant_config['public_ip']
    config.ssh.forward_agent = vagrant_config['vagrant_ssh_forward_agent']
    config.vm.hostname = vagrant_config['hostname']
    config.vm.provision "ansible" do |ansible|
        ansible.playbook = "build/playbook.yml"
        ansible.inventory_path = "build/inventories/local"
        ansible.limit = 'development'
    end
    config.vm.synced_folder "./", vagrant_config['vagrant_synced_folder']
end
