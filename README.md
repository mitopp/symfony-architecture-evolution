# Symfony Architecture Evolution

> **Vom RAD-Prototyp zum sauberen Code**
>
> Dieses Repository demonstriert die schrittweise Evolution einer Symfony-Anwendung – von einem schnellen Rapid-Application-Development-Prototyp (RAD) hin zu einer sauberen, wartbaren und testbaren Architektur.

Weiterführende Informationen und alle Artikel dieser Serie findest du auf meinem [Blog](https://mitopp.de/blog).

## Übersicht & Konzept

In vielen realen Projekten beginnt die Entwicklung mit schnellen Prototypen (Fat Controllers, direkte Doctrine-Abhängigkeiten in UI-Schichten, schnelle CRUD-Generierung). Im Laufe der Zeit steigen jedoch die Anforderungen an Wartbarkeit, Skalierbarkeit und Testbarkeit.

Dieses Projekt zeigt anhand verschiedener Branches und Evolutionsstufen, wie typische Refactorings und Architekturmuster in Symfony umgesetzt werden:

- **Trennung von Zuständigkeiten:** Controller schlank halten, Geschäftslogik kapseln
- **Domain-Driven Design (DDD) / Clean Architecture Ansätze:** Entkopplung von Framework- und Infrastrukturdetails
- **CQRS & Asynchronität:** Trennung von Lese- und Schreiboperationen mit Symfony Messenger
- **Testbarkeit:** Unit-, Integrations- und Functional-Tests für robuste Software

---

## Branches & Evolutionsstufen

Die verschiedenen Stufen der Architektur und spezifische Feature-Implementierungen sind in dedizierten Branches organisiert.

| Branch                      | Stufe / Thema               | Beschreibung                    |
|-----------------------------|-----------------------------|---------------------------------|
| `main`                      | **Projekt**                 | Das komplette Beispiel Projekt  |
| `01-rad-controller-magic`   | **RAD-Controller-Magic**    | Der Fluch des schnellen Erfolgs |
| `02-dedicated-form-classes` | **Dedizierte Form-Klassen** | Befreit die Formulare           |

> *Hinweis: Neue Feature-Branches und Architekturstufen werden hier kontinuierlich dokumentiert und verlinkt.*

---

## Systemanforderungen

- **PHP:** >= 8.4 (mit Extensions `ctype`, `iconv`)
- **Composer:** >= 2.x
- **Docker & Docker Compose:** Für Datenbankdienste (PostgreSQL 16)
- **Optional:** [Symfony CLI](https://symfony.com/download) für lokale Serververwaltung

---

## Installation & Schnellstart

### 1. Repository klonen & Abhängigkeiten installieren

```bash
git clone <repository-url>
cd symfony-architecture-evolution
composer install
```

### 2. Infrastruktur (Docker) starten

Starte die PostgreSQL-Datenbank über Docker Compose:

```bash
docker compose up -d
```

*(Hinweis: Bei Nutzung der Symfony CLI startet der Docker-Container über die `.symfony.local.yaml` automatisch mit dem Webserver.)*

### 3. Datenbank initialisieren

```bash
# Datenbank anlegen
php bin/console doctrine:database:create --if-not-exists

# Migrationen ausführen
php bin/console doctrine:migrations:migrate --no-interaction
```

### 4. Lokalen Entwicklungsserver starten

Mit der **Symfony CLI** (empfohlen):

```bash
symfony serve
```

Die Anwendung ist standardmäßig unter `http://127.0.0.1:8888` erreichbar.

Alternativ mit dem integrierten PHP-Webserver:

```bash
php -S 127.0.0.1:8888 -t public
```

---

## Tests ausführen

Das Projekt nutzt PHPUnit für Unit-, Integrations- und Web-Tests:

```bash
php bin/phpunit
```

---

## Nützliche Befehle (Workflow)

```bash
# Cache leeren
php bin/console cache:clear

# Routen anzeigen
php bin/console debug:router

# Services & Autowiring prüfen
php bin/console debug:autowiring

# Container & Konfiguration validieren
php bin/console lint:container
php bin/console lint:yaml config/

# Code style
php vendor/bin/php-cs-fixer fix --dry-run
php vendor/bin/twig-cs-fixer check
php vendor/bin/rector --dry-run

# Statische Code Analyse
php vendor/bin/phpstan analyse
```

In der `composer.json` sind noch entsprechende Aliase definiert.

```
composer run-script
```

---

## Lizenz

Dieses Projekt ist für Schulungs- und Demonstrationszwecke gedacht und wurde unter der [MIT-Lizenz](LICENSE) veröffentlicht.
