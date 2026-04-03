<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hobby;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'elmahdi.tamika@gmail.com',
            'password' => Hash::make('password@tamika'),
        ]);

        // Profile
        Profile::create([
            'name' => 'Elmahdi Tamika',
            'title_fr' => 'Développeur Full-Stack',
            'title_en' => 'Full-Stack Developer',
            'bio_fr' => 'Fort de 8 ans d\'expérience en développement web, je suis un développeur Full-stack qualifié et professionnel. Créatif et analytique, je suis également un joueur d\'équipe attentif aux détails. Expert en .NET, Laravel, Angular, Vue.js et Java, j\'interviens aussi bien sur le front-end que le back-end pour concevoir des solutions robustes et performantes.',
            'bio_en' => 'With 8 years of experience in web development, I am a qualified and professional Full-stack developer. Creative and analytical, I am also a team player with great attention to detail. Expert in .NET, Laravel, Angular, Vue.js and Java, I work on both front-end and back-end to design robust and high-performance solutions.',
            'email' => 'elmahdi.tamika@gmail.com',
            'phone' => '+212-6-28-87-19-89',
            'github' => null,
            'linkedin' => null,
            'website' => 'https://www.elmahditamika.com',
            'location' => 'Témara, Maroc',
            'available' => true,
            'years_experience' => 8,
        ]);

        // Experiences
        $experiences = [
            [
                'company' => 'SIS Consultants | Fondation Mohammed 6',
                'position_fr' => 'Développeur .NET C# / Laravel',
                'position_en' => '.NET C# / Laravel Developer',
                'description_fr' => 'Maintenance des applications .NET WebForm et .NET Core MVC. Développement d\'applications web en Laravel pour la Fondation Mohammed 6.',
                'description_en' => 'Maintenance of .NET WebForm and .NET Core MVC applications. Development of web applications in Laravel for the Mohammed 6 Foundation.',
                'start_date' => '2023-11-01',
                'end_date' => null,
                'is_current' => true,
                'location' => 'Maroc',
                'contract_type' => 'CDI',
                'order' => 1,
            ],
            [
                'company' => 'DIGITRANSFORM',
                'position_fr' => 'Développeur Sénior .NET C# / Java / Angular',
                'position_en' => 'Senior .NET C# / Java / Angular Developer',
                'description_fr' => 'Conception et analyse des besoins, création de bases de données, développement front-end et back-end, ainsi que correction des bugs et anomalies. Projets réalisés : PractAssist (application orthophonistes, Java/Angular), TransNow (application transporteurs, Java/Angular), MDC (application d\'audit, .NET/Vue.js), SportCarriere (site de recrutement française, .NET/Angular), GSM Maroc (e-commerce, .NET/Angular), LeBord (application d\'éducation au Tchad, .NET/Angular), AssuVie (CMS, .NET/Angular).',
                'description_en' => 'Requirements analysis and design, database creation, front-end and back-end development, bug and anomaly fixes. Projects: PractAssist (speech therapists app, Java/Angular), TransNow (transport app, Java/Angular), MDC (audit app, .NET/Vue.js), SportCarriere (French recruitment site, .NET/Angular), GSM Maroc (e-commerce, .NET/Angular), LeBord (education app in Chad, .NET/Angular), AssuVie (CMS, .NET/Angular).',
                'start_date' => '2021-10-01',
                'end_date' => '2023-10-31',
                'is_current' => false,
                'location' => 'Maroc',
                'contract_type' => 'CDI',
                'order' => 2,
            ],
            [
                'company' => 'MARIT',
                'position_fr' => 'Développeur .NET / Angular / PHP',
                'position_en' => '.NET / Angular / PHP Developer',
                'description_fr' => 'Réalisation de sites internet et intranets pour le secteur public avec ASP.NET, .NET Core, WebForm, SharePoint et Angular. Clients : Ministère de la Transition Énergétique et du Développement Durable, Ministère de l\'Aménagement du Territoire National, de l\'Urbanisme, de l\'Habitat et de la Politique de la Ville.',
                'description_en' => 'Development of websites and intranets for the public sector using ASP.NET, .NET Core, WebForm, SharePoint and Angular. Clients: Ministry of Energy Transition and Sustainable Development, Ministry of National Territorial Planning, Urban Planning, Housing and City Policy.',
                'start_date' => '2018-10-01',
                'end_date' => '2021-08-31',
                'is_current' => false,
                'location' => 'Maroc',
                'contract_type' => 'CDI',
                'order' => 3,
            ],
            [
                'company' => 'SafeScore',
                'position_fr' => 'Développeur PHP (Laravel) et WebDev',
                'position_en' => 'PHP (Laravel) and WebDev Developer',
                'description_fr' => 'Conception et réalisation d\'applications de sécurité et d\'audit. Migration des projets de WebDev vers PHP Laravel pour de grands clients français : Carrefour, Décathlon, Sephora et Kiloutou.',
                'description_en' => 'Design and development of security and audit applications. Migration of projects from WebDev to PHP Laravel for major French clients: Carrefour, Décathlon, Sephora and Kiloutou.',
                'start_date' => '2017-06-01',
                'end_date' => '2018-07-31',
                'is_current' => false,
                'location' => 'Maroc',
                'contract_type' => 'CDI',
                'order' => 4,
            ],
            [
                'company' => 'Groupe Scolaire Eljaouzia',
                'position_fr' => 'Développeur Informatique',
                'position_en' => 'IT Developer',
                'description_fr' => 'Réalisation du site web de l\'école et d\'une application de gestion de stock. Maintenance d\'une application de scolarité en PHP. Préparation et animation de formations en informatique pour les enseignants.',
                'description_en' => 'Development of the school website and a stock management application. Maintenance of a school management application in PHP. Preparation and delivery of IT training for teachers.',
                'start_date' => '2015-12-01',
                'end_date' => '2017-06-30',
                'is_current' => false,
                'location' => 'Maroc',
                'contract_type' => 'CDI',
                'order' => 5,
            ],
            [
                'company' => 'CIVILIA',
                'position_fr' => 'Stage | Développeur Web',
                'position_en' => 'Internship | Web Developer',
                'description_fr' => 'Réalisation d\'un site internet avec HTML5, CSS et PHP.',
                'description_en' => 'Development of a website using HTML5, CSS and PHP.',
                'start_date' => '2015-10-01',
                'end_date' => '2015-12-31',
                'is_current' => false,
                'location' => 'Maroc',
                'contract_type' => 'Stage',
                'order' => 6,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }

        // Education
        $educations = [
            [
                'school' => 'SUPMTI',
                'degree_fr' => 'Bac+4 — Ingénierie des Systèmes d\'Information',
                'degree_en' => 'Bac+4 — Information Systems Engineering',
                'field_fr' => 'Ingénierie des Systèmes d\'Information',
                'field_en' => 'Information Systems Engineering',
                'description_fr' => 'Formation de niveau Bac+4 en ingénierie des systèmes d\'information à SUPMTI.',
                'description_en' => 'Bac+4 level training in information systems engineering at SUPMTI.',
                'start_year' => 2017,
                'end_year' => 2019,
                'order' => 1,
            ],
            [
                'school' => 'Institut Supérieur de Technologie Appliquée',
                'degree_fr' => 'Technicien Spécialisé en Développement Informatique',
                'degree_en' => 'Specialized Technician in Computer Development',
                'field_fr' => 'Développement Informatique',
                'field_en' => 'Computer Development',
                'description_fr' => 'Formation de technicien spécialisé en développement informatique à l\'ISTA.',
                'description_en' => 'Specialized technician training in computer development at ISTA.',
                'start_year' => 2012,
                'end_year' => 2014,
                'order' => 2,
            ],
        ];

        foreach ($educations as $edu) {
            Education::create($edu);
        }

        // Skills
        $skills = [
            // Frontend
            ['name' => 'Angular', 'category' => 'frontend', 'icon' => '🔴', 'level' => 90, 'order' => 1],
            ['name' => 'Vue.js', 'category' => 'frontend', 'icon' => '💚', 'level' => 85, 'order' => 2],
            ['name' => 'JavaScript / jQuery', 'category' => 'frontend', 'icon' => '🟡', 'level' => 88, 'order' => 3],
            ['name' => 'HTML5 / CSS3', 'category' => 'frontend', 'icon' => '🌐', 'level' => 92, 'order' => 4],
            ['name' => 'Tailwind CSS', 'category' => 'frontend', 'icon' => '🎨', 'level' => 85, 'order' => 5],
            ['name' => 'Bootstrap', 'category' => 'frontend', 'icon' => '💜', 'level' => 88, 'order' => 6],
            // Backend
            ['name' => 'C# ASP.NET / .NET Core', 'category' => 'backend', 'icon' => '🔵', 'level' => 93, 'order' => 7],
            ['name' => 'Laravel / PHP', 'category' => 'backend', 'icon' => '🔴', 'level' => 90, 'order' => 8],
            ['name' => 'Java', 'category' => 'backend', 'icon' => '☕', 'level' => 82, 'order' => 9],
            ['name' => 'Node.js', 'category' => 'backend', 'icon' => '🟢', 'level' => 70, 'order' => 10],
            ['name' => 'ADO.NET', 'category' => 'backend', 'icon' => '🔷', 'level' => 85, 'order' => 11],
            // Bases de données
            ['name' => 'SQL Server', 'category' => 'tools', 'icon' => '🗄️', 'level' => 88, 'order' => 12],
            ['name' => 'MySQL / PostgreSQL', 'category' => 'tools', 'icon' => '🐬', 'level' => 85, 'order' => 13],
            ['name' => 'Oracle', 'category' => 'tools', 'icon' => '🔶', 'level' => 75, 'order' => 14],
            ['name' => 'SharePoint', 'category' => 'tools', 'icon' => '📋', 'level' => 72, 'order' => 15],
            ['name' => 'WinDev / WebDev', 'category' => 'tools', 'icon' => '🪟', 'level' => 78, 'order' => 16],
            ['name' => 'C / C++ / VB', 'category' => 'other', 'icon' => '⚙️', 'level' => 70, 'order' => 17],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Certificates
        $certificates = [
            [
                'title_fr' => 'Programming in C#',
                'title_en' => 'Programming in C#',
                'organization' => 'Microsoft',
                'issued_date' => '2014-01-01',
                'expiry_date' => null,
                'credential_url' => null,
                'description_fr' => 'Certification Microsoft en programmation C#.',
                'description_en' => 'Microsoft certification in C# programming.',
                'order' => 1,
            ],
            [
                'title_fr' => 'MS Project',
                'title_en' => 'MS Project',
                'organization' => 'Microsoft',
                'issued_date' => '2014-01-01',
                'expiry_date' => null,
                'credential_url' => null,
                'description_fr' => 'Certification Microsoft en gestion de projets avec MS Project.',
                'description_en' => 'Microsoft certification in project management with MS Project.',
                'order' => 2,
            ],
            [
                'title_fr' => 'Administering Microsoft SQL Server 2012 Databases',
                'title_en' => 'Administering Microsoft SQL Server 2012 Databases',
                'organization' => 'Microsoft',
                'issued_date' => '2014-01-01',
                'expiry_date' => null,
                'credential_url' => null,
                'description_fr' => 'Certification Microsoft en administration des bases de données SQL Server 2012.',
                'description_en' => 'Microsoft certification in administering SQL Server 2012 databases.',
                'order' => 3,
            ],
        ];

        foreach ($certificates as $cert) {
            Certificate::create($cert);
        }

        // Hobbies
        $hobbies = [
            ['name_fr' => 'Sport', 'name_en' => 'Sport', 'icon' => '⚽', 'color' => '#10b981', 'order' => 1],
            ['name_fr' => 'Voyage', 'name_en' => 'Travel', 'icon' => '✈️', 'color' => '#3b82f6', 'order' => 2],
        ];

        foreach ($hobbies as $hobby) {
            Hobby::create($hobby);
        }

        // Projects
        $projects = [
            [
                'title_fr' => 'SportCarriere — Site de recrutement',
                'title_en' => 'SportCarriere — Recruitment Website',
                'description_fr' => 'Site de recrutement française développé avec ASP.NET et Angular. Gestion des offres d\'emploi, candidatures et profils professionnels dans le secteur sportif.',
                'description_en' => 'French recruitment website developed with ASP.NET and Angular. Job listing management, applications and professional profiles in the sports sector.',
                'demo_url' => 'https://www.sportcarriere.com',
                'github_url' => null,
                'technologies' => ['ASP.NET', 'Angular', 'SQL Server'],
                'featured' => true,
                'order' => 1,
            ],
            [
                'title_fr' => 'PractAssist — Application des orthophonistes',
                'title_en' => 'PractAssist — Speech Therapists App',
                'description_fr' => 'Application de gestion pour les orthophonistes développée en Java et Angular. Gestion des patients, séances, bilans et suivi thérapeutique.',
                'description_en' => 'Management application for speech therapists developed in Java and Angular. Patient management, sessions, assessments and therapeutic follow-up.',
                'demo_url' => 'https://app.pract-assist.com/',
                'github_url' => null,
                'technologies' => ['Java', 'Angular', 'PostgreSQL'],
                'featured' => true,
                'order' => 2,
            ],
            [
                'title_fr' => 'MDC — Application d\'audit',
                'title_en' => 'MDC — Audit Application',
                'description_fr' => 'Application d\'audit interne développée avec .NET et Vue.js. Gestion des audits, rapports, plans d\'action et suivi des non-conformités.',
                'description_en' => 'Internal audit application developed with .NET and Vue.js. Audit management, reports, action plans and non-conformity tracking.',
                'demo_url' => null,
                'github_url' => null,
                'technologies' => ['.NET', 'Vue.js', 'SQL Server'],
                'featured' => true,
                'order' => 3,
            ],
            [
                'title_fr' => 'Applications Ministères — Secteur Public',
                'title_en' => 'Ministry Applications — Public Sector',
                'description_fr' => 'Développement de sites internet et intranets pour le Ministère de la Transition Énergétique et le Ministère de l\'Aménagement du Territoire avec ASP.NET, SharePoint et Angular.',
                'description_en' => 'Development of websites and intranets for the Ministry of Energy Transition and the Ministry of Territorial Planning using ASP.NET, SharePoint and Angular.',
                'demo_url' => 'https://www.mem.gov.ma',
                'github_url' => null,
                'technologies' => ['ASP.NET', 'SharePoint', 'Angular', 'SQL Server'],
                'featured' => false,
                'order' => 4,
            ],
            [
                'title_fr' => 'Applications Sécurité & Audit — SafeScore',
                'title_en' => 'Security & Audit Applications — SafeScore',
                'description_fr' => 'Applications de sécurité et d\'audit pour Carrefour, Décathlon, Sephora et Kiloutou. Migration WebDev → PHP Laravel.',
                'description_en' => 'Security and audit applications for Carrefour, Décathlon, Sephora and Kiloutou. WebDev → PHP Laravel migration.',
                'demo_url' => null,
                'github_url' => null,
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'WebDev'],
                'featured' => false,
                'order' => 5,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
