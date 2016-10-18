# irohajirui-sho-docker

### Required
- OS: MacOS 10.10
  - applicable for Docker on Mac

### Preparation
- install Ansible2.X, Docker
- setup docker-machine，and create host machine named `default`
  - if you already have another host machine, modify `[docker_host]` value in `hosts`
  - you also modify `ssh_config` settings according to your docker-machine and host machine settings
- execute commands below to enable ansible to unarchive app
  - `cd app`
  - `tar cvf irohajirui-sho.tar irohajirui-sho/*`
  - `mv irohajirui-sho.tar ../setup/roles/iroha/files/`

### Setup
- execute ansible playbook to create Docker container and application setup
  - `ansible-playbook -i hosts site.yml`
- access `http://192.168.99.100:8080` and verify application web page is shown

