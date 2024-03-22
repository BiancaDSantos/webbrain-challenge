<?php

class Database {
    private static $conn;

    public static function getConn() {
        if (self::$conn == null) {
            $servername = "127.0.0.1:3306";
            $username = "root";
            $password = "root";
            $database = "webbrain";

            try {
                self::$conn = new PDO(
                    "mysql:host=$servername;",
                    $username,
                    $password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $result = self::$conn->query("select schema_name from information_schema.schemata where schema_name = '$database'");
                $databaseExists = $result->fetch(PDO::FETCH_ASSOC);

                if (!$databaseExists) {
                    self::$conn->exec("create database if not exists $database");
                }
                
                self::$conn = new PDO(
                    "mysql:host=$servername;dbname=$database",
                    $username,
                    $password
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                if (!$databaseExists) {
                    self::$conn->exec("
                        create table company_infos (
                            id int not null auto_increment,
                            name varchar(100) not null,
                            street varchar(100) not null,
                            district varchar(100) not null,
                            zip_code char(9) not null,
                            city varchar(100) not null,
                            state char(2) not null,
                            office_hours varchar(50) not null,
                            number_phone varchar(18) not null,
                            whatsapp varchar(19) not null,
                            whatsapp_link blob null,
                            map_link blob null,
                        primary key (id));
                    ");

                    self::$conn->exec("
                        insert into company_infos (
                            name,
                            street,
                            district,
                            zip_code,
                            city,
                            state,
                            office_hours,
                            number_phone,
                            whatsapp,
                            whatsapp_link,
                            map_link 
                        ) values (
                            'Web Brain Tecnologia',
                            'Rua Duarte Costa, 865',
                            'Santa Barbara',
                            '88804-337',
                            'Criciúma',
                            'SC',
                            '08h até as 18h | Seg à Sex',
                            '(48) 2102-7493',
                            '(48) 2102-7493',
                            '554821027493',
                            'https://www.google.com.br/maps/place/R.+Duarte+da+Costa,+860+-+Michel,+Criciúma+-+SC,+88804-495/@-28.6905701,-49.3809402,17z/data=!3m1!4b1!4m6!3m5!1s0x9521826453f82997:0x2d5eb507829d991a!8m2!3d-28.6905748!4d-49.3783653!16s%2Fg%2F11f3dq3xjj?entry=tt'
                        );
                    ");

                    self::$conn->exec("
                        create table contact_options (
                            id int not null auto_increment,
                            description varchar(100) not null,
                        primary key (id));                      
                    ");

                    self::$conn->exec("
                        insert into contact_options (
                            description
                        ) values (
                            'Sugestão'
                        );
                    ");

                    self::$conn->exec("
                        insert into contact_options (
                            description
                        ) values (
                            'Dúvida'
                        );
                    ");

                    self::$conn->exec("
                        insert into contact_options (
                            description
                        ) values (
                            'Elogio'
                        );
                    ");

                    self::$conn->exec("
                        insert into contact_options (
                            description
                        ) values (
                            'Crítica'
                        );
                    ");

                    self::$conn->exec("
                        insert into contact_options (
                            description
                        ) values (
                            'Outros'
                        );
                    ");

                    self::$conn->exec("
                        create table contacts (
                            id int not null auto_increment,
                            name varchar(100) not null,
                            birth_date date not null,
                            email varchar(100) not null,
                            whatsapp varchar(15) not null,
                            phone varchar(14) not null,
                            message blob not null,
                        primary key (id));
                    ");

                    self::$conn->exec("
                        create table contact_contact_options (
                            id int not null auto_increment,
                            contact_id int not null,
                            contact_options_id int not null,
                            primary key (id),
                            index contact_id_idx (contact_id asc) visible,
                            index contact_contact_options_contact_options_id_idx (contact_options_id asc) visible,
                            constraint contact_contact_options_contact_id
                                foreign key (contact_id)
                                references contacts (id)
                                on delete no action
                                on update cascade,
                            constraint contact_contact_options_contact_options_id
                                foreign key (contact_options_id)
                                references contact_options (id)
                                on delete no action
                                on update cascade
                        );
                    ");
                }
            } catch(PDOException $e) {
                echo "Erro na conexão com o banco de dados: " . $e->getMessage();
            }   
        }
        return self::$conn;
    }
}