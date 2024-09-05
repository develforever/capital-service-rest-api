<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:user-create',
    description: 'Create user',
)]
class UserCreateCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager, private UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
    }

    protected function configure(  ): void
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'Username')
            ->addArgument('password', InputArgument::REQUIRED, 'Password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');

        $user = new User();
        $user->setUsername($username);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);
        
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('User created.');

        return Command::SUCCESS;
    }
}
