<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@github.com:zeroibc/test.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys 
set('shared_files', [
    '2.txt'
]);
set('shared_dirs', [
    'public'
]);

// Writable dirs by web server 
set('writable_dirs', []);

set('ssh_multiplexing', true);

// Hosts

host('47.107.73.162')
    ->set('deploy_path', '/var/www/html/{{application}}')
    ->user('deployer')
    ->identityFile('~/.ssh/deployerkey');
// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
//    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
