<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\Command\GetDataFromService' shared autowired service.

include_once $this->targetDirs[3].'\\vendor\\symfony\\console\\Command\\Command.php';
include_once $this->targetDirs[3].'\\src\\Command\\GetDataFromService.php';

$this->privates['App\Command\GetDataFromService'] = $instance = new \App\Command\GetDataFromService(NULL, ($this->privates['App\Repository\SourceRepository'] ?? $this->load('getSourceRepositoryService.php')), ($this->privates['App\Repository\CurrencyRepository'] ?? $this->load('getCurrencyRepositoryService.php')));

$instance->setName('app:getData');

return $instance;
