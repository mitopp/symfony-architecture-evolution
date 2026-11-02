# Symfony Architektur-Evolution

Dieses Repository ist der offizielle Begleit-Code zur 7-teiligen Blog-Serie **"Von Symfony-Magie zur sauberen Architektur"** auf [mitopp.de](https://mitopp.de/blog).

In dieser Serie bauen wir gemeinsam eine simple Event-Anmeldung (RSVP) und refactoren sie Schritt für Schritt von einem "Quick & Dirty"-Prototypen hin zu einer sauberen, testbaren und wartbaren Architektur.

## Wie funktioniert dieses Repository?

Der Code ist so aufgebaut, dass jeder Blog-Artikel seinen eigenen Git-Branch hat. Du kannst dir jeden Zwischenschritt isoliert ansehen oder über `git diff` genau nachvollziehen, was sich von einem Schritt zum nächsten geändert hat.

Beispiel, um die Änderungen von Teil 2 auf Teil 3 zu sehen:

~~~bash
git diff 02-dedicated-form-classes..03-form-dtos
~~~

## Die Architektur-Reise (Branches)

Hier ist die Übersicht aller Artikel und der zugehörigen Branches. Springe in den Branch, um den Endzustand des jeweiligen Artikels zu sehen.

| Teil  | Branch                      | Thema & Artikel-Link                                                                                                   | Kern-Lernziel                                                                                                      |
|:------|:----------------------------|:-----------------------------------------------------------------------------------------------------------------------|:-------------------------------------------------------------------------------------------------------------------|
| **1** | `01-rad-controller-magic`   | **[Frameworks - Der schnelle Erfolg](https://mitopp.de/blog/der-schnelle-erfolg-warum-wir-frameworks-lieben)**         | Rapid Application Development (RAD). Ein fertiges Feature in 15 Minuten – alles passiert im "God Controller".      |
| **2** | `02-dedicated-form-classes` | **[Befreit die Formulare!](https://mitopp.de/blog/befreit-die-formulare-dedizierte-form-klassen)**                     | Single Responsibility Principle. Den FormBuilder in eigene Klassen auslagern, um Wiederverwendbarkeit zu schaffen. |
| **3** | `03-form-dtos`              | **[Die toxische Beziehung](https://mitopp.de/blog/die-toxische-beziehung-warum-entitaten-nicht-in-formulare-gehoren)** | Warum Entities nicht ins Formular gehören. Einführung von Form-DTOs für echte Typsicherheit.                       |
| **4** | `04-service-extraction`     | **[Controller auf Diät](https://mitopp.de/blog/controller-auf-diat-business-logik-in-services-auslagern)**             | Geschäftslogik in Application Services kapseln. Der Controller wird zum reinen HTTP-Verwalter.                     |
| **5** | `05-view-dtos`              | **[Die unsichtbare Gefahr im Template](https://mitopp.de/blog/die-unsichtbare-gefahr-im-template-entities-vs-dtos)**   | Frontend von der Datenbank entkoppeln. Verhinderung von N+1-Queries und Daten-Leaks mittels View-DTOs.             |
| **6** | `06-repository-interfaces`  | **[Wer speichert hier eigentlich?](https://mitopp.de/blog/wer-speichert-hier-eigentlich-repository-interfaces)**       | Dependency Inversion. Das System durch Repository-Interfaces komplett vom ORM (Doctrine) entkoppeln.               |
| **7** | `07-decorator-caching`      | **[Caching wie von Zauberhand](https://mitopp.de/blog/caching-wie-von-zauberhand-das-decorator-pattern)**              | Das Decorator Pattern in Aktion. Einen blitzschnellen Cache vorschalten, ohne den Bestandscode anzufassen.         |

## Lokales Setup

Wenn du den Code lokal ausführen möchtest, benötigst du PHP 8.2+ und Composer. Eine lokale Datenbank ist erforderlich (z.B. via Docker, SQLite oder Symfony Local Web Server).

### Repository klonen:

~~~bash
git clone https://github.com/mitopp/symfony-architecture-evolution.git
cd symfony-architecture-evolution
~~~

### Abhängigkeiten installieren:

~~~bash
composer install
~~~

### Datenbank konfigurieren:

Kopiere die .env zu .env.local und passe die DATABASE_URL an (für einen schnellen Start kannst du auch SQLite nutzen):

~~~bash
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
~~~

### Datenbank & Tabellen erstellen:

~~~bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
~~~

### Entwicklungsserver starten:

~~~bash
symfony server:start
~~~

Jetzt kannst du die Applikation im Browser öffnen. Wechsle einfach den Branch (`git checkout 04-service-extraction`), um den Fortschritt der Architektur live zu testen!
