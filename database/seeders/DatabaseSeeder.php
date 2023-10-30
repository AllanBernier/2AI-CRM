<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Subcontractor;
use App\Models\TjmType;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'name' => 'allan',
            'email' => 'allan.bernier1@gmail.com',
            'password' => Hash::make('00000000'),
        ]);

        $m2i = Company::factory()->create(['name' => 'm2i']);
        $orsys = Company::factory()->create(['name' => 'orsys']);
        $ib = Company::factory()->create(['name' => 'ib']);

        TjmType::create(['name' => 'POE']);
        TjmType::create(['name' => 'INIT']);
        TjmType::create(['name' => 'PERF']);
        TjmType::create(['name' => 'AVC']);

       // JAV-DW	Java EE - Développement Web et d'applications d'entreprise	675	5

        Product::create(['code' => 'PRF-INFRA', 'description' => 'Plan régional de formations', 'url' => '', 'tjm' => 0, 'duree' => 0, 'company_id' => $m2i->id]);
        Product::create(['code' => 'POE DEVOPS', 'description' => 'POE Devops de 57 jours découpée en plages horaires / modules', 'url' => '', 'tjm' => '600', 'duree' => 0, 'company_id' => $m2i->id]);
        Product::create(['code' => 'POE SALESFORCE', 'description' => 'POE Salesforce de 57 jours découpée en plages horaires / modules', 'url' => '', 'tjm' => '550', 'duree' => 0, 'company_id' => $m2i->id]);
        Product::create(['code' => 'POE JAVA', 'description' => 'POE Java de 57 jours découpée en plages horraires / modules', 'url' => '', 'tjm' => '550', 'duree' => 0, 'company_id' => $m2i->id]);
        Product::create(['code' => '2ITECH CDA', 'description' => 'Concepteur Développeur d\'Applications', 'url' => '', 'tjm' => '600', 'duree' => 0, 'company_id' => $m2i->id]);
        Product::create(['code' => 'JAV-DW', 'description' => 'Java EE - Développement Web et d\'applications d\'entreprise', 'url' => '', 'tjm' => '675', 'duree' => '5', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JVS-ANGU', 'description' => 'Angular 2 à 13 - Développement d\'applications Web', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JVS-ANGAV', 'description' => 'Angular 2 à 13 - Fonctionnalités avancées', 'url' => '', 'tjm' => '675', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'CS-AV', 'description' => 'C# 11 / Framework .NET - Développement avancé', 'url' => '', 'tjm' => '675', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => '.NET-REST', 'description' => '.NET - Développer des services Web avec REST', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'HTM-FND', 'description' => 'Html css les fondamentaux', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'PGRE-SQL', 'description' => 'PostgreSQL 15 - Administration', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JVS-REA', 'description' => 'ReactJS - Développement d\'applications Web', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'PHO-IN', 'description' => 'Photoshop - Initiation', 'url' => '', 'tjm' => '400', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'GIT-VER', 'description' => 'Git - Gérer le versioning', 'url' => '', 'tjm' => '650', 'duree' => '2', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JVS-VUE', 'description' => 'Vue.js - Développement d\'applications Web', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'PYT', 'description' => 'Python - Par la pratique', 'url' => '', 'tjm' => '650', 'duree' => '4', 'company_id' => $m2i->id]);
        Product::create(['code' => 'REAC-APP', 'description' => 'React Native - Apprendre à développer et publier une application mobile native sur les stores', 'url' => '', 'tjm' => '650', 'duree' => '2', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JVS-IN', 'description' => 'JavaScript - Fondamentaux', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'PYT-DJAN', 'description' => 'Django - Développements Web en Python', 'url' => '', 'tjm' => '650', 'duree' => '4', 'company_id' => $m2i->id]);
        Product::create(['code' => 'IND-IN', 'description' => 'InDesign - Initiation', 'url' => '', 'tjm' => '400', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'SPRG-BOOT', 'description' => 'Spring Boot', 'url' => '', 'tjm' => '675', 'duree' => '2', 'company_id' => $m2i->id]);
        Product::create(['code' => 'AGI-MET', 'description' => 'Comprendre la démarche Agile', 'url' => '', 'tjm' => '650', 'duree' => '2', 'company_id' => $m2i->id]);
        Product::create(['code' => 'PYT-IOT', 'description' => 'Programmation Python en IoT pour Raspberry', 'url' => '', 'tjm' => '750', 'duree' => '5', 'company_id' => $m2i->id]);
        Product::create(['code' => 'ACCNUM-FND', 'description' => 'Les fondamentaux de l\'accessibilité numérique', 'url' => '', 'tjm' => '650', 'duree' => '1', 'company_id' => $m2i->id]);
        Product::create(['code' => 'SCRUM', 'description' => 'Formation Méthodes Agiles Scrum', 'url' => '', 'tjm' => '675', 'duree' => '2', 'company_id' => $m2i->id]);
        Product::create(['code' => 'FIGMA-PROT', 'description' => 'Figma - Design d\'interface - Prototypages, mockups, wireframes', 'url' => '', 'tjm' => '500', 'duree' => '2', 'company_id' => $m2i->id]);
        Product::create(['code' => 'CS-PRE', 'description' => 'C# - Développement avec WPF', 'url' => '', 'tjm' => '700', 'duree' => '4', 'company_id' => $m2i->id]);
        Product::create(['code' => 'CS-MVC', 'description' => 'C# - Développement Web avec ASP.NET MVC 5 et 6', 'url' => '', 'tjm' => '750', 'duree' => '4', 'company_id' => $m2i->id]);
        Product::create(['code' => 'CSS-AV', 'description' => 'CSS 3 avancé et Responsive Design', 'url' => '', 'tjm' => '675', 'duree' => '2', 'company_id' => $m2i->id]);
        Product::create(['code' => 'CS-FRM', 'description' => 'Programmation C# - Développer en .NET avec Visual Studio', 'url' => '', 'tjm' => '675', 'duree' => '5', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JAV-SE', 'description' => 'Java - Les fondamentaux de la programmation', 'url' => '', 'tjm' => '625', 'duree' => '5', 'company_id' => $m2i->id]);
        Product::create(['code' => 'KOTL-FND', 'description' => 'Kotlin - Mise en oeuvre', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'DOCK-DEPL', 'description' => 'Docker - Mise en oeuvre et déploiement de conteneurs virtuels', 'url' => '', 'tjm' => '700', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'PHP-PE', 'description' => 'PHP 5, 7 et 8 - Développement Web avancé et programmation objet', 'url' => '', 'tjm' => '700', 'duree' => '5', 'company_id' => $m2i->id]);
        Product::create(['code' => 'AND-PRG', 'description' => 'Android - Développement natif en Java', 'url' => '', 'tjm' => '650', 'duree' => '5', 'company_id' => $m2i->id]);
        Product::create(['code' => 'MY-ADM', 'description' => 'MySQL 8 - Administration', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'PHP-IN', 'description' => 'PHP 5, 7 et 8 - Développement d\'applications Web', 'url' => '', 'tjm' => '650', 'duree' => '4', 'company_id' => $m2i->id]);
        Product::create(['code' => 'SPRG-FRW', 'description' => 'Spring 5 Framework - Développer des applications d\'entreprise', 'url' => '', 'tjm' => '650', 'duree' => '4', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JAV-NEW', 'description' => 'Java - Nouveautés des versions 8 à 17', 'url' => '', 'tjm' => '675', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'WOR-PRES', 'description' => 'WordPress - Initiation - Création et gestion d\'un site Web', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'BOO-IN', 'description' => 'Bootstrap 5 - Système de grille', 'url' => '', 'tjm' => '650', 'duree' => '2', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JVS-NOD', 'description' => 'Node.js - Développement d\'applications Web', 'url' => '', 'tjm' => '675', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JVS-AV', 'description' => 'JavaScript - Programmation avancée', 'url' => '', 'tjm' => '675', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'CPP-QT5IN', 'description' => 'Librairie C++ Qt5 - Initiation', 'url' => '', 'tjm' => '700', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'PYT-PE', 'description' => 'Python - Perfectionnement', 'url' => '', 'tjm' => '700', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'LARA-FRW', 'description' => 'Formation PHP Laravel', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'SPRG-FRWAV', 'description' => 'Développeur Java Spring 5 Framework - Fonctionnalités avancées', 'url' => '', 'tjm' => '675', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JAV-WS', 'description' => 'Java - Développer des services Web avec SOAP', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'OBJ-INT', 'description' => 'Conception et langages Introduction à la programmation objet', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JAV-DVO', 'description' => 'Développeur Java - Pour les développeurs objet', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'CPP-20', 'description' => 'Langage C++ Langage C++20 - Mise à niveau', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JAV-DWS', 'description' => 'Développeur Java - Développement des Web Services', 'url' => '', 'tjm' => '650', 'duree' => '4', 'company_id' => $m2i->id]);
        Product::create(['code' => 'RGAA-DEV', 'description' => 'Comment développer des sites Web accessibles (RGAA 4.1 ou WCAG 2.1)', 'url' => '', 'tjm' => '675', 'duree' => '2', 'company_id' => $m2i->id]);
        Product::create(['code' => 'GIT-LAB', 'description' => 'Formation Industrialisation du logiciel', 'url' => '', 'tjm' => '650', 'duree' => '3', 'company_id' => $m2i->id]);
        Product::create(['code' => 'JAV-AV', 'description' => 'Développeur Java Java - Programmation avancée', 'url' => '', 'tjm' => '675', 'duree' => '4', 'company_id' => $m2i->id]);
        Product::create(['code' => 'UNI-3D', 'description' => 'Unity 3D - Moteur de jeu multiplateforme', 'url' => '', 'tjm' => '650', 'duree' => '5', 'company_id' => $m2i->id]);
        Product::create(['code' => 'IND-N1', 'description' => 'InDesign - Initiation longue pour les professionnels de la communication', 'url' => '', 'tjm' => '400', 'duree' => '5', 'company_id' => $m2i->id]);
        Product::create(['code' => 'PHO-N1', 'description' => 'Photoshop - Initiation longue pour les professionnels de la communication', 'url' => '', 'tjm' => '400', 'duree' => '5', 'company_id' => $m2i->id]);
        Product::create(['code' => 'ARC-JEE', 'description' => 'Architectures d\'entreprise JEE', 'url' => '', 'tjm' => '675', 'duree' => '2', 'company_id' => $m2i->id]);

        Product::create(['code' => 'IB000', 'description' => 'Développement mobile pour piloter des développements sur iOS et Android - Niveau les fondamentaux', 'url' => '', 'tjm' => '600', 'duree' => '2', 'company_id' => $ib->id]);
        Product::create(['code' => 'LI248', 'description' => 'Initiation à la programmation avec Python', 'url' => '', 'tjm' => '650', 'duree' => '2', 'company_id' => $ib->id]);
        Product::create(['code' => 'LI270', 'description' => 'Vue.js - Développement d\'application Web', 'url' => '', 'tjm' => '600', 'duree' => '3', 'company_id' => $ib->id]);
        Product::create(['code' => 'LI250', 'description' => 'Python - Perfectionnement', 'url' => '', 'tjm' => '700', 'duree' => '4', 'company_id' => $ib->id]);
        Product::create(['code' => 'LI268', 'description' => 'Angular 2+ - Développements avancés', 'url' => '', 'tjm' => '700', 'duree' => '3', 'company_id' => $ib->id]);
        Product::create(['code' => 'MB312', 'description' => 'Kotlin, développer des applications pour Android', 'url' => '', 'tjm' => '750', 'duree' => '4', 'company_id' => $ib->id]);
        Product::create(['code' => 'MB313', 'description' => 'React Native - Développer des applications mobiles natives pour iOS et Android', 'url' => '', 'tjm' => '600', 'duree' => '3', 'company_id' => $ib->id]);
        Product::create(['code' => 'CE954', 'description' => 'JavaScript - Programmation avancée', 'url' => '', 'tjm' => '700', 'duree' => '3', 'company_id' => $ib->id]);
        Product::create(['code' => 'OB303', 'description' => 'Développement Java avancé et accès aux données', 'url' => '', 'tjm' => '650', 'duree' => '4', 'company_id' => $ib->id]);
        Product::create(['code' => 'LI210', 'description' => 'PHP 7 - Développement avancé et programmation Objet', 'url' => '', 'tjm' => '650', 'duree' => '4', 'company_id' => $ib->id]);
        Product::create(['code' => 'IXU51', 'description' => 'Formation - PostgreSQL - Développement Développer des solutions de données professionnelles', 'url' => '', 'tjm' => '600', 'duree' => '2', 'company_id' => $ib->id]);
        Product::create(['code' => 'POE .NET', 'description' => 'POE .net de 57 jours découpée en plages horaires / modules', 'url' => '', 'tjm' => '600', 'duree' => 0, 'company_id' => $ib->id]);
        Product::create(['code' => 'LI249', 'description' => 'Formation - Python - Programmation Objet', 'url' => '', 'tjm' => '600', 'duree' => '5', 'company_id' => $ib->id]);
        Product::create(['code' => 'LI262', 'description' => 'Formation - Conception d\'interfaces graphiques full JavaScript avec Angular, TypeScript et Bootstrap', 'url' => '', 'tjm' => '650', 'duree' => '5', 'company_id' => $ib->id]);
        Product::create(['code' => 'LA200', 'description' => 'Formation - C++ - Programmation Objet', 'url' => '', 'tjm' => '650', 'duree' => '5', 'company_id' => $ib->id]);

        Product::create(['code' => 'UTP', 'description' => 'AutoCAD 3D, prise en main', 'url' => '', 'tjm' => '400', 'duree' => '3', 'company_id' => $orsys->id]);
        Product::create(['code' => 'JAVA CUSTOM', 'description' => 'Formation Java personnalisée aux besoins du client', 'url' => '', 'tjm' => '700', 'duree' => 0, 'company_id' => $orsys->id]);
        Product::create(['code' => 'JPG', 'description' => 'Formation : JavaScript, perfectionnement', 'url' => '', 'tjm' => '700', 'duree' => '4', 'company_id' => $orsys->id]);
        Product::create(['code' => 'ANY', 'description' => 'Formation : Angular, développement avancé', 'url' => '', 'tjm' => '700', 'duree' => '3', 'company_id' => $orsys->id]);
        Product::create(['code' => 'SGT', 'description' => 'Formation - Développer avec Spring Boot', 'url' => '', 'tjm' => '700', 'duree' => '3', 'company_id' => $orsys->id]);
        Product::create(['code' => 'DHL', 'description' => 'Formation : JavaScript, HTML dynamique', 'url' => '', 'tjm' => '650', 'duree' => '4', 'company_id' => $orsys->id]);
        Product::create(['code' => 'DAH', 'description' => 'Formation : Swift, développer des applications pour iOS - iPhone/iPad', 'url' => '', 'tjm' => '700', 'duree' => '5', 'company_id' => $orsys->id]);
        Product::create(['code' => 'Etude de cas', 'description' => 'Etude de cas pour Orsys', 'url' => '', 'tjm' => '400', 'duree' => '1', 'company_id' => $orsys->id]);
        Product::create(['code' => 'PYT-INIT', 'description' => 'Formation : Python, programmation Objet', 'url' => '', 'tjm' => '650', 'duree' => '5', 'company_id' => $orsys->id]);

        Customer::create(['first_name' => 'Roseline', 'last_name' => 'BELLEN-VIZINHO', 'role' => '', 'phone' => '', 'email' => 'r.bellen-vizinho@m2iformation.fr', 'city' => '', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Lorane', 'last_name' => 'LHOTEL', 'role' => 'Assistant commercial', 'phone' => '33189199903', 'email' => 'l.lhotel@m2iformation.fr', 'city' => '?', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Vincent ', 'last_name' => 'CALONNEC', 'role' => 'POE Chef de projet', 'phone' => '', 'email' => 'v.calonnec@m2iformation.fr', 'city' => 'Paris', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Barbara', 'last_name' => 'ROBIN', 'role' => 'INTER planification', 'phone' => '442393402', 'email' => 'b.robin@m2iformation.fr', 'city' => 'Aix en provence', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Laurent', 'last_name' => 'GAUDIN', 'role' => 'POE Chef de projet', 'phone' => '', 'email' => 'l.gaudin@m2iformation.fr', 'city' => 'Lyon', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Juana', 'last_name' => 'GERMANEAU', 'role' => 'POE Chef de projet', 'phone' => '', 'email' => 'j.germaneau@m2iformation.fr', 'city' => 'Niort', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Aurélie', 'last_name' => 'OLIVIER', 'role' => 'POE Chef de projet', 'phone' => '', 'email' => 'a.olivier@m2iformation.fr', 'city' => 'Nantes', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Alexandra', 'last_name' => 'BONENFANT', 'role' => 'INTRA planification', 'phone' => '', 'email' => 'a.bonnenfant@m2iformation.fr', 'city' => 'Paris', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Colline', 'last_name' => 'MASSOUBRE', 'role' => 'Enregistrement formateurs', 'phone' => '', 'email' => 'c.massoubre@m2iformation.fr', 'city' => 'Paris', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Stéphanie', 'last_name' => 'WILKOSZ', 'role' => 'POE Chef de projet', 'phone' => '', 'email' => 's.wilkosz@m2iformation.fr', 'city' => 'Lille', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Grégory', 'last_name' => 'COLOMAR', 'role' => 'DA', 'phone' => '', 'email' => 'g.colomar@m2iformation.fr', 'city' => 'Lille', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Amaury', 'last_name' => 'DELCOURT', 'role' => 'DA', 'phone' => '', 'email' => 'a.delcourt@m2iformation.fr', 'city' => 'Lille', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Agnès', 'last_name' => 'RICHIR', 'role' => 'Assistant commercial', 'phone' => '', 'email' => 'a.richir@m2iformation.fr', 'city' => 'Bordeaux', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Françoise', 'last_name' => 'MOREL', 'role' => 'Assistant commercial', 'phone' => '', 'email' => 'f.morel@m2iformation.fr', 'city' => 'Lyon', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Amanda', 'last_name' => 'BERTIN', 'role' => 'Assistant commercial', 'phone' => '', 'email' => 'a.bertin@m2iformation.fr', 'city' => 'Bordeaux', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Mélanie', 'last_name' => 'GRAILLON', 'role' => '', 'phone' => '', 'email' => 'm.graillon@m2iformation.fr', 'city' => '', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Aurélie', 'last_name' => 'BERRINI', 'role' => '', 'phone' => '', 'email' => 'a.berrini@m2iformation.fr', 'city' => '', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Séverine', 'last_name' => 'HACCOUN', 'role' => '', 'phone' => '', 'email' => 's.haccoun@m2iformation.fr', 'city' => '', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Test', 'last_name' => 'TEST', 'role' => 'POE Chef de projet', 'phone' => '', 'email' => 'contact@2aiconcept.com', 'city' => 'Paris', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Véronique', 'last_name' => 'LHERMITTE', 'role' => 'Assistant commercial', 'phone' => '247488848', 'email' => 'v.lhermitte@m2iformation.fr', 'city' => 'Tours', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Martine', 'last_name' => 'SEVESTRE', 'role' => 'Commercial', 'phone' => '660652605', 'email' => 'm.sevestre@m2iformation.fr', 'city' => 'Paris', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Anna-Maria', 'last_name' => 'PAIVA', 'role' => 'Sourcing & planif', 'phone' => '189199911', 'email' => 'am.paiva@m2iformation.fr', 'city' => '', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Ludivine', 'last_name' => 'GAGNEAUD', 'role' => '', 'phone' => '', 'email' => 'l.gagneaud@m2iformation.fr', 'city' => '', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Sandrine', 'last_name' => 'NÉBOUT', 'role' => 'DA', 'phone' => '330687609141', 'email' => 's.nebout@m2iformation.fr', 'city' => 'Montpellier', 'company_id' => $m2i->id]);
        Customer::create(['first_name' => 'Mélissa', 'last_name' => 'VALTON', 'role' => 'Recrutement Formateur', 'phone' => '33189199909', 'email' => 'm.valton@m2iformation.fr', 'city' => 'Paris (92)', 'company_id' => $m2i->id]);

        Customer::create(['first_name' => 'Fanny', 'last_name' => 'HUTET', 'role' => 'Résponsable centre rennes', 'phone' => '788862563', 'email' => 'fhutet@orsys.fr', 'city' => 'Rennes', 'company_id' => $orsys->id]);
        Customer::create(['first_name' => 'Victoria', 'last_name' => 'DELAUNAY', 'role' => 'Sourcing & planif', 'phone' => '', 'email' => 'vdelaunay@orsys.fr', 'city' => '', 'company_id' => $orsys->id]);
        Customer::create(['first_name' => 'Aurélie', 'last_name' => 'BENKAROUN', 'role' => 'Sourcing & planif', 'phone' => '', 'email' => 'abenkarounparis@orsys.fr', 'city' => 'Paris', 'company_id' => $orsys->id]);
        Customer::create(['first_name' => 'Alyson', 'last_name' => 'CURPEN', 'role' => '', 'phone' => '', 'email' => 'acurpen@orsys.fr', 'city' => '', 'company_id' => $orsys->id]);
        Customer::create(['first_name' => 'Mélissa', 'last_name' => 'SELLAM', 'role' => '', 'phone' => '33659044797', 'email' => 'msellam@orsys.fr', 'city' => 'Limoges', 'company_id' => $orsys->id]);
        Customer::create(['first_name' => 'Fabien', 'last_name' => 'HERMET', 'role' => '', 'phone' => '33614812129', 'email' => 'fhermet@orsys.fr', 'city' => '', 'company_id' => $orsys->id]);
        Customer::create(['first_name' => 'Morgane', 'last_name' => 'MARSZALEK', 'role' => '', 'phone' => '', 'email' => 'mmarszalek@orsys.fr', 'city' => '', 'company_id' => $orsys->id]);
        Customer::create(['first_name' => 'Joaline', 'last_name' => 'COMA', 'role' => 'INTRA planification', 'phone' => '', 'email' => 'jcoma@orsys.fr', 'city' => '', 'company_id' => $orsys->id]);

        Customer::create(['first_name' => 'Arnaud', 'last_name' => 'BOUCLY', 'role' => '', 'phone' => '', 'email' => 'Arnaud.BOUCLY@ib.cegos.fr', 'city' => '', 'company_id' => $ib->id]);
        Customer::create(['first_name' => 'Nathalie', 'last_name' => 'ANDRIEUX', 'role' => '', 'phone' => '33141992031', 'email' => 'Nathalie.ANDRIEUX@ib.cegos.fr', 'city' => '', 'company_id' => $ib->id]);
        Customer::create(['first_name' => 'Line', 'last_name' => 'TRAN', 'role' => '', 'phone' => '', 'email' => 'Line.TRAN@ib.cegos.fr', 'city' => '', 'company_id' => $ib->id]);
        Customer::create(['first_name' => 'Laurence', 'last_name' => 'TOUILIN', 'role' => '', 'phone' => '251899088', 'email' => 'Laurence.TOUILIN@ib.cegos.fr', 'city' => '', 'company_id' => $ib->id]);

        Subcontractor::create(['first_name' => 'Alexandre', 'last_name' => 'CASES', 'email_perso' => 'a.cases@cleverdev.fr', 'phone' => '660587058', 'email_company' => 'a.cases@2aiconcept.com', 'company_name' => 'CLEVERDEV','city' => 'Marseille / France']);
        Subcontractor::create(['first_name' => 'Allan', 'last_name' => 'BERNIER', 'email_perso' => 'allan.bernier1@gmail.com', 'phone' => '642024873', 'email_company' => 'a.bernier@2aiconcept.com', 'company_name' => 'BERNIER','city' => 'Rennes / France']);
        Subcontractor::create(['first_name' => 'Arnaud', 'last_name' => 'BODEL', 'email_perso' => 'arnaud.bodel@gmail.com', 'phone' => '648409599', 'email_company' => 'a.bodel@2aiconcept.com', 'company_name' => 'BODEL','city' => 'Lille / France']);
        Subcontractor::create(['first_name' => 'Audrey', 'last_name' => 'DONJON', 'email_perso' => 'donjon.audrey@gmail.com', 'phone' => '768612403', 'email_company' => 'a.donjon@2aiconcept.com', 'company_name' => 'DONJON','city' => 'Île de france / France']);
        Subcontractor::create(['first_name' => 'Aunim', 'last_name' => 'HASSAN', 'email_perso' => 'nicolas.haziza@gmail.com', 'phone' => '613449424', 'email_company' => 'a.hassan@2aiconcept.com', 'company_name' => 'HAZIZA','city' => 'Toulouse / France']);
        Subcontractor::create(['first_name' => 'Christian', 'last_name' => 'BWANAKAWA', 'email_perso' => 'christian.lisangola@gmail.com', 'phone' => '', 'email_company' => 'c.bwanakawa@2aiconcept.com', 'company_name' => 'LISANGOLA','city' => 'rdc']);
        Subcontractor::create(['first_name' => 'Christian', 'last_name' => 'LISANGOLA', 'email_perso' => 'christian.lisangola@gmail.com', 'phone' => '254792669410', 'email_company' => 'c.lisangola@2aiconcept.com', 'company_name' => 'LISANGOLA','city' => 'Kinshasa / RDC']);
        Subcontractor::create(['first_name' => 'Christophe', 'last_name' => 'GUEROULT', 'email_perso' => 'c.gueroult@2aiconcept.com', 'phone' => '', 'email_company' => 'c.gueroult@2aiconcept.com', 'company_name' => '2AI CONCEPT LTD','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Christopher', 'last_name' => 'LOISEL', 'email_perso' => 'contact@redstoneformations.fr', 'phone' => '33769069096', 'email_company' => 'c.loisel@2aiconcept.com', 'company_name' => 'MECHETY','city' => 'Île de france / France']);
        Subcontractor::create(['first_name' => 'Davy', 'last_name' => 'BUREAU', 'email_perso' => 'davy.bureau@gmail.com', 'phone' => '630082034', 'email_company' => 'd.bureau@2aiconcept.com', 'company_name' => 'BUREAU','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Dylan', 'last_name' => 'MEURIOT', 'email_perso' => 'd.meuriot@2aiconcept.com', 'phone' => '656856554', 'email_company' => 'd.meuriot@2aiconcept.com', 'company_name' => 'MEURIOT','city' => 'Liège / Belgique']);
        Subcontractor::create(['first_name' => 'François', 'last_name' => 'CAREMOLI', 'email_perso' => 'francois.caremoli@wanadoo.fr', 'phone' => '672774563', 'email_company' => 'f.caremoli@2aiconcept.com', 'company_name' => 'HEPHAISTOS','city' => 'Bretagne / France']);
        Subcontractor::create(['first_name' => 'Glodie', 'last_name' => 'TSHIMINI', 'email_perso' => 'contact@tshimini.fr', 'phone' => '620519791', 'email_company' => 'g.tshimini@2aiconcept.com', 'company_name' => 'TSHIMINI','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Guilian', 'last_name' => 'GANSTER', 'email_perso' => 'guilian.ganster@wisoftify.fr', 'phone' => '767676761', 'email_company' => 'g.ganster@2aiconcept.com', 'company_name' => 'GANSTER','city' => 'Rennes / France']);
        Subcontractor::create(['first_name' => 'Jean-Christophe', 'last_name' => 'DOMINGUEZ', 'email_perso' => 'jcd.pro@gmail.com', 'phone' => '767665195', 'email_company' => 'jc.dominguez@2aiconcept.com', 'company_name' => 'DOMINGUEZ','city' => 'Montpellier / France']);
        Subcontractor::create(['first_name' => 'Jeremy', 'last_name' => 'BOJKO', 'email_perso' => 'jeremy.bojko.pro@protonmail.com', 'phone' => '677843165', 'email_company' => 'j.bojko@2aiconcept.com', 'company_name' => 'BOJKO','city' => 'Bagnolet / France']);
        Subcontractor::create(['first_name' => 'Jonathan', 'last_name' => 'BERTEAUX', 'email_perso' => 'berteauxj@gmail.com', 'phone' => '761723708', 'email_company' => 'j.berteaux@2aiconcept.com', 'company_name' => 'BERTEAUX','city' => 'La Rochelle / France']);
        Subcontractor::create(['first_name' => 'Kenza', 'last_name' => 'AUBRY', 'email_perso' => 'contact@redstoneformations.fr', 'phone' => '33695312112', 'email_company' => 'k.aubry@2aiconcept.com', 'company_name' => 'MECHETY','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Macha', 'last_name' => 'DA-COSTA', 'email_perso' => 'macha.dacosta@gmail.com', 'phone' => '786260601', 'email_company' => 'm.dacosta@2aiconcept.com', 'company_name' => 'DA-COSTA','city' => 'Cannes / France']);
        Subcontractor::create(['first_name' => 'Marc', 'last_name' => 'DESCHAMPS', 'email_perso' => 'deschamps.ma@gmail.com', 'phone' => '672155097', 'email_company' => 'm.deschamps@2aiconcept.com', 'company_name' => 'DESCHAMPS','city' => 'Île de france / France']);
        Subcontractor::create(['first_name' => 'Morgan', 'last_name' => 'GUY', 'email_perso' => 'contact@redstoneformations.fr', 'phone' => '695841974', 'email_company' => 'm.guy@2aiconcept.com', 'company_name' => 'MECHETY','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Mostapha-Bachir', 'last_name' => 'ADDI', 'email_perso' => 'contact@redstoneformations.fr', 'phone' => '33659602401', 'email_company' => 'mb.addi@2aiconcept.com', 'company_name' => 'MECHETY','city' => 'Île de france / France']);
        Subcontractor::create(['first_name' => 'Nicolas', 'last_name' => 'HAZIZA', 'email_perso' => 'nicolas.haziza@gmail.com', 'phone' => '627232994', 'email_company' => 'n.haziza@2aiconcept.com', 'company_name' => 'HAZIZA','city' => 'Toulouse / France']);
        Subcontractor::create(['first_name' => 'Olivier', 'last_name' => 'BLAIVIE', 'email_perso' => 'o.blaivie@gmail.com', 'phone' => '665319137', 'email_company' => 'o.blaivie@2aiconcept.com', 'company_name' => 'BLAIVIE','city' => '? / France']);
        Subcontractor::create(['first_name' => 'Patrick', 'last_name' => 'WAMPE', 'email_perso' => 'wampepatrick@gmail.com', 'phone' => '768100947', 'email_company' => 'p.wampe@2aiconcept.com', 'company_name' => 'WAMPE','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Quentin', 'last_name' => 'BIDOLET', 'email_perso' => 'quentin.bidolet@gmail.com', 'phone' => '644027008', 'email_company' => 'q.bidolet@2aiconcept.com', 'company_name' => 'BIDOLET','city' => 'Dijon / France']);
        Subcontractor::create(['first_name' => 'Rayan', 'last_name' => 'MECHETY', 'email_perso' => 'contact@redstoneformations.fr', 'phone' => '695841974', 'email_company' => 'r.mechety@2aiconcept.com', 'company_name' => 'MECHETY','city' => 'Île de france / France']);
        Subcontractor::create(['first_name' => 'Samih', 'last_name' => 'HABBANI', 'email_perso' => 'samihhabbani@gmail.com', 'phone' => '782148141', 'email_company' => 's.habbani@2aiconcept.com', 'company_name' => 'HABBANI','city' => 'Cannes / France']);
        Subcontractor::create(['first_name' => 'Sion', 'last_name' => 'ISRAEL', 'email_perso' => 'sion.israel.pro@gmail.com', 'phone' => '243818772740', 'email_company' => 's.israel@2aiconcept.com', 'company_name' => 'ISRAEL','city' => 'Montreal / Canada']);
        Subcontractor::create(['first_name' => 'Sofiane', 'last_name' => 'KANOUNI', 'email_perso' => 'sofiane.kanouni@hotmail.fr', 'phone' => '616843088', 'email_company' => 's.kanouni@2aiconcept.com', 'company_name' => 'KANOUNI','city' => 'Champagne / France']);
        Subcontractor::create(['first_name' => 'Sonia', 'last_name' => 'BAIBOU', 'email_perso' => 's.baibou@gmail.com', 'phone' => '661051594', 'email_company' => 's.baibou@2aiconcept.com', 'company_name' => 'BAIBOU','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Stephanie', 'last_name' => 'CAREMOLI', 'email_perso' => 'steph.vigoureux@gmail.com', 'phone' => '656858433', 'email_company' => 's.caremoli@2aiconcept.com', 'company_name' => 'CAREMOLI','city' => 'Clisson / France']);
        Subcontractor::create(['first_name' => 'Steve', 'last_name' => 'GOUIN', 'email_perso' => 'gs.gouin@gmail.com', 'phone' => '612950020', 'email_company' => 's.gouin@2aiconcept.com', 'company_name' => 'GOUIN','city' => 'Île de france / France']);
        Subcontractor::create(['first_name' => 'Victor', 'last_name' => 'PORTENSEIGNE', 'email_perso' => 'contact@redstoneformations.fr', 'phone' => '695841974', 'email_company' => 'v.portenseigne@2aiconcept.com', 'company_name' => 'MECHETY','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Vincent', 'last_name' => 'ARTZ', 'email_perso' => 'artzvincent@gmail.com', 'phone' => '695841974', 'email_company' => 'v.artz@2aiconcept.com', 'company_name' => 'ARTZ','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Wilfrid', 'last_name' => 'MOREL', 'email_perso' => 'wilfrid_mo@hotmail.com', 'phone' => '650518354', 'email_company' => 'w.morel@2aiconcept.com', 'company_name' => 'MOREL','city' => 'Salon / France']);
        Subcontractor::create(['first_name' => 'Xavier', 'last_name' => 'TABUTEAU', 'email_perso' => 'formation.informatique.86@gmail.com', 'phone' => '632623339', 'email_company' => 'x.tabuteau@2aiconcept.com', 'company_name' => 'TABUTEAU','city' => 'Poitiers / France']);
        Subcontractor::create(['first_name' => 'Geoffrey', 'last_name' => 'DEMAISON', 'email_perso' => 'contact@redstoneformations.fr', 'phone' => '695841974', 'email_company' => 'g.demaison@2aiconcept.com', 'company_name' => 'MECHETY','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Adam', 'last_name' => 'JEMAA', 'email_perso' => 'contact@redstoneformations.fr', 'phone' => '33766060975', 'email_company' => 'a.jemaa@2aiconcept.com', 'company_name' => 'MECHETY','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Benjamin', 'last_name' => 'MEYER', 'email_perso' => '', 'phone' => '', 'email_company' => '', 'company_name' => 'MECHETY','city' => '']);
        Subcontractor::create(['first_name' => 'Anthony', 'last_name' => 'DEMON', 'email_perso' => 'demon.anthony95@gmail.com', 'phone' => '768528389', 'email_company' => 'a.demon@2aiconcept.com', 'company_name' => 'DEMON','city' => 'Dijon / France']);
        Subcontractor::create(['first_name' => 'Nehemie', 'last_name' => 'BALUKIDI', 'email_perso' => 'christian.lisangola@gmail.com', 'phone' => '', 'email_company' => 'n.balukidi@2aiconcept.com', 'company_name' => 'LISANGOLA','city' => '']);
        Subcontractor::create(['first_name' => 'Balogun', 'last_name' => 'OLA-DAVIES', 'email_perso' => 'boladavies@gmail.com', 'phone' => '668153658', 'email_company' => 'b.oladavies@2aiconcept.com', 'company_name' => 'OLA-DAVIES','city' => 'Paris / France']);
        Subcontractor::create(['first_name' => 'Samuel', 'last_name' => 'NEVEU', 'email_perso' => 'samuel.neveugall@gmail.com', 'phone' => '33782216779', 'email_company' => '', 'company_name' => '','city' => 'Rennes / France']);


        for($i=0;$i<100;$i++){
            $product = Product::select('id', 'company_id' ,)->inRandomOrder()->first();

            Training::create([
                'status' => fake()->randomElement(['nouveau', 'confirmé', 'option', 'archivé']),
                'product_id' => $product->id,
                'customer_id' => Customer::query()->where('company_id', $product->company_id)->inRandomOrder()->first()->id,
                'subcontractor_id' => Subcontractor::inRandomOrder()->first()->id,
                'tjm_client' => 600 + fake()->numberBetween(0,4) * 25,
                'tjm_subcontractor' => 300 + fake()->numberBetween(0,8) * 25,
                'duree' => fake()->randomFloat(1,1,5),
                'start_date' => fake()->dateTimeThisMonth()->format('Y-m-d'),
                'end_date' => fake()->dateTimeThisMonth()->format('Y-m-d'),
                'num_session' => fake()->postcode,
                'num_bdc' => fake()->postcode,
                'travelling_expenses' => 0,
                'location' => fake()->city,
                'action_customer' =>  fake()->randomElement(['AR Nouveau', 'Envoyé Intervenant', 'Relance Option', 'AR BDC', 'Envoyé changement sur option', 'Envoyé changement sur confirmation', 'Envoyé refus', '' ]),
                'action_subcontractor' =>  fake()->randomElement(['Solliciter', 'Solliciter dates', 'Envoyé bon d\'option', 'Bon pour accord', 'Annuler une option', 'Annuler une confirmation', '']),
            ]);
        }


    }
}
