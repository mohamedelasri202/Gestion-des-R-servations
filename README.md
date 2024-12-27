# Système de Réservation de Voyages

## Contexte du Projet

Le **Système de Réservation de Voyages** est une solution moderne visant à améliorer la gestion des réservations au sein d'une agence de voyage. Ce système, développé en utilisant une approche orientée objet (OOP), permet de gérer les utilisateurs, les activités (vols, hôtels, circuits touristiques), ainsi que les réservations. L'objectif principal est d'offrir une expérience utilisateur optimale tout en assurant une gestion fluide et efficace des opérations liées aux voyages.

## 🎯 Objectifs du Projet

Le projet vise à fournir une solution complète pour la gestion de :

- **Les utilisateurs** : Différents rôles tels que client et administrateur, chacun avec des autorisations et des capacités spécifiques.
- **Les activités** : Gestion des offres de voyages incluant les vols, hôtels, et circuits touristiques.
- **Les réservations** : Permettre aux clients de réaliser des réservations, de les modifier ou d'annuler.

## 🚀 Fonctionnalités Backend Attendues

### 🔐 Authentification et Autorisation

- **Système sécurisé d’inscription et de connexion** pour les clients.
- **Gestion des rôles** :
  - **Administrateur** : Accède à la gestion des utilisateurs et des activités.
  - **Client authentifié** : Peut effectuer des réservations, les modifier et les annuler.
  - **Visiteur** : Peut consulter les offres sans être connecté.

### 👤 User Stories

#### 🛠️ En tant qu'Administrateur

- **Gestion des utilisateurs et rôles** :
  - Créer un compte sécurisé pour accéder au système.
  - Attribuer des rôles aux utilisateurs.
  
- **Gestion des activités** :
  - Ajouter, modifier ou supprimer des activités disponibles.
  
- **Gestion des réservations** :
  - Visualiser les réservations en cours.
  - Confirmer ou annuler des réservations.

- **Gestion des utilisateurs** :
  - Archiver ou bannir des utilisateurs en cas de besoin.

#### 👥 En tant que Client Authentifié

- **Consultation des offres** :
  - Rechercher et consulter les activités disponibles, incluant les vols, hôtels et circuits.
  
- **Personnalisation** :
  - Sélectionner des activités et personnaliser des options selon les préférences.

- **Réservation et modification** :
  - Réaliser une réservation en ligne.
  - Modifier ou annuler une réservation si nécessaire.

#### 👀 En tant que Visiteur

- **Consultation du catalogue** :
  - Parcourir les activités disponibles sans se connecter.
  - Consulter les détails de chaque activité.

- **Inscription** :
  - Créer un compte pour accéder aux fonctionnalités de réservation et personnalisation.

## 🛠️ Technologies Utilisées

- **Langages** : PHP, HTML, CSS, JavaScript.
- **Base de données** : MySQL.
- **Frameworks** : Symfony / Laravel (si applicable).
- **Système de gestion de versions** : Git, GitHub.

## 📦 Installation

1. **Clonez le dépôt** :

```bash
git clone https://github.com/mohamedelasri202/Gestion-des-R-servations.git
