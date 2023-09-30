<?php

namespace App\Commands;

use RdKafka\Exception;
use RdKafka\Producer;
use RdKafka\Conf;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:kafka',
    description: 'kafka test',
    aliases: ['app:kafka'],
    hidden: false
)]
class KafkaSandbox extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try{
            $conf = new Conf();
            $conf->set('bootstrap.servers','pkc-921jm.us-east-2.aws.confluent.cloud:9092');
            $conf->set('security.protocol','SASL_SSL');
            $conf->set('sasl.mechanisms','PLAIN');
            $conf->set('sasl.username','UFIEBYQIZLYLJ7DK');
            $conf->set('sasl.password','fbMOhtdN7M5ZB4K9KhPr5FZ9bqSas2NL9+VutY6S23GlGiV8YKRjI587cYHo36Uv');

            $output->writeln('creating producer');
            $rk = new Producer($conf);
            $rk->addBrokers('pkc-921jm.us-east-2.aws.confluent.cloud:9092');

            $output->writeln('attempting to connect to topic');
            $topic = $rk->newTopic('part_created');
            $topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode(['part_name'=>'test1','created_time'=>'2023-10-01 10:08:55','creator' => 'Cpt. Grimace']));
            $rk->flush('15000');

            return Command::SUCCESS;
        }catch (\Exception $e){
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
    }
}