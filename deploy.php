<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'shenanigans');

// Project repository
set('repository', 'git@github.com:stygian91/mc-shenanigans-laravel.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

host('stygian.leeta.webdock.io')
    ->user('deploy')
    ->set('deploy_path', '~/{{application}}');

// Tasks

task('build', function () {
    run('cd {{release_path}} && yarn && yarn prod');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'build');
before('deploy:symlink', 'artisan:migrate');

