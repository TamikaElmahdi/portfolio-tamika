import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createI18n } from 'vue-i18n'
import '../css/app.css'

const messages = {
    fr: {
        nav: {
            home: 'Accueil',
            about: 'À propos',
            skills: 'Compétences',
            experience: 'Expérience',
            education: 'Formation',
            certificates: 'Certifications',
            projects: 'Projets',
            hobbies: 'Loisirs',
            contact: 'Contact',
        },
        hero: {
            greeting: 'Bonjour, je suis',
            cta_projects: 'Voir mes projets',
            cta_contact: 'Me contacter',
            available: 'Disponible pour missions',
            not_available: 'Non disponible',
            years_exp: "Ans d'expérience",
            projects_done: 'Projets réalisés',
            scroll: 'Défiler',
        },
        about: {
            title: 'À propos de moi',
            subtitle: 'Mon parcours et ma passion',
            download_cv: 'Télécharger CV',
            location: 'Localisation',
            email: 'Email',
            phone: 'Téléphone',
            experience: "Ans d'expérience",
        },
        skills: {
            title: 'Mes Compétences',
            subtitle: 'Technologies maîtrisées',
            frontend: 'Frontend',
            backend: 'Backend',
            tools: 'Outils',
            other: 'Autres',
        },
        experience: {
            title: 'Expérience Professionnelle',
            subtitle: 'Mon parcours professionnel',
            current: 'Actuel',
            present: 'Présent',
        },
        education: {
            title: 'Formation',
            subtitle: 'Mon parcours académique',
        },
        certificates: {
            title: 'Certifications',
            subtitle: 'Mes certifications professionnelles',
            issued: 'Délivré le',
            expires: 'Expire le',
            view: 'Voir le certificat',
        },
        projects: {
            title: 'Mes Projets',
            subtitle: 'Ce que j\'ai réalisé',
            demo: 'Démo',
            github: 'Code source',
            view_all: 'Voir tous les projets',
        },
        hobbies: {
            title: 'Loisirs & Intérêts',
            subtitle: 'Ce qui me passionne en dehors du code',
        },
        contact: {
            title: 'Me Contacter',
            subtitle: 'Discutons de votre projet',
            name: 'Nom complet',
            email: 'Adresse email',
            subject: 'Sujet',
            message: 'Message',
            send: 'Envoyer le message',
            sending: 'Envoi en cours...',
            success: 'Message envoyé avec succès!',
            info_title: 'Informations de contact',
            follow: 'Me suivre',
        },
        admin: {
            dashboard: 'Tableau de bord',
            profile: 'Profil',
            experiences: 'Expériences',
            educations: 'Formations',
            skills: 'Compétences',
            certificates: 'Certifications',
            hobbies: 'Loisirs',
            projects: 'Projets',
            messages: 'Messages',
            logout: 'Déconnexion',
            create: 'Créer',
            edit: 'Modifier',
            delete: 'Supprimer',
            save: 'Enregistrer',
            cancel: 'Annuler',
            back: 'Retour',
            unread: 'Non lu',
        },
    },
    en: {
        nav: {
            home: 'Home',
            about: 'About',
            skills: 'Skills',
            experience: 'Experience',
            education: 'Education',
            certificates: 'Certificates',
            projects: 'Projects',
            hobbies: 'Hobbies',
            contact: 'Contact',
        },
        hero: {
            greeting: 'Hello, I am',
            cta_projects: 'View my projects',
            cta_contact: 'Contact me',
            available: 'Available for work',
            not_available: 'Not available',
            years_exp: 'Years of experience',
            projects_done: 'Projects completed',
            scroll: 'Scroll',
        },
        about: {
            title: 'About Me',
            subtitle: 'My background and passion',
            download_cv: 'Download CV',
            location: 'Location',
            email: 'Email',
            phone: 'Phone',
            experience: 'Years of experience',
        },
        skills: {
            title: 'My Skills',
            subtitle: 'Technologies I master',
            frontend: 'Frontend',
            backend: 'Backend',
            tools: 'Tools',
            other: 'Other',
        },
        experience: {
            title: 'Work Experience',
            subtitle: 'My professional journey',
            current: 'Current',
            present: 'Present',
        },
        education: {
            title: 'Education',
            subtitle: 'My academic background',
        },
        certificates: {
            title: 'Certifications',
            subtitle: 'My professional certifications',
            issued: 'Issued on',
            expires: 'Expires on',
            view: 'View certificate',
        },
        projects: {
            title: 'My Projects',
            subtitle: 'What I have built',
            demo: 'Demo',
            github: 'Source code',
            view_all: 'View all projects',
        },
        hobbies: {
            title: 'Hobbies & Interests',
            subtitle: 'What I am passionate about outside of code',
        },
        contact: {
            title: 'Contact Me',
            subtitle: 'Let\'s discuss your project',
            name: 'Full name',
            email: 'Email address',
            subject: 'Subject',
            message: 'Message',
            send: 'Send message',
            sending: 'Sending...',
            success: 'Message sent successfully!',
            info_title: 'Contact information',
            follow: 'Follow me',
        },
        admin: {
            dashboard: 'Dashboard',
            profile: 'Profile',
            experiences: 'Experiences',
            educations: 'Education',
            skills: 'Skills',
            certificates: 'Certificates',
            hobbies: 'Hobbies',
            projects: 'Projects',
            messages: 'Messages',
            logout: 'Logout',
            create: 'Create',
            edit: 'Edit',
            delete: 'Delete',
            save: 'Save',
            cancel: 'Cancel',
            back: 'Back',
            unread: 'Unread',
        },
    },
}

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const locale = props.initialPage.props.locale || 'fr'
        const i18n = createI18n({
            legacy: false,
            locale: locale,
            fallbackLocale: 'en',
            messages,
        })
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18n)
            .mount(el)
    },
})
