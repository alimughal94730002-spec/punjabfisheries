# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Project Overview

This is the **Punjab Fisheries – Digital Transformation Platform**, a comprehensive government administrative system for fish farming management. The platform includes CMS capabilities, CRM functionality, multi-language support, AI chatbot integration, and role-based access control.

**Technology Stack:**
- Laravel 12.x (PHP 8.2+)
- TailwindCSS + Alpine.js + Axios
- PostgreSQL/MySQL with Redis support
- Spatie Laravel Permission (RBAC)
- Spatie Media Library (WordPress-like media management)
- Pest PHP for testing
- Vite for asset compilation

## Development Commands

### Environment Setup
```bash
# Copy environment file and generate key
cp .env.example .env
php artisan key:generate

# Install dependencies
composer install
npm install

# Database setup
php artisan migrate --seed

# Create storage symlink for media files
php artisan storage:link
```

### Development Workflow
```bash
# Start development environment (all services)
composer run dev
# This runs: server, queue listener, logs, and vite concurrently

# Individual services
php artisan serve                    # Development server
php artisan queue:listen --tries=1  # Queue worker
php artisan pail --timeout=0        # Log monitoring
npm run dev                         # Vite development server

# Build assets for production
npm run build
```

### Testing
```bash
# Run all tests
composer run test
# This runs: php artisan config:clear && php artisan test

# Run specific test types
php artisan test                     # All tests with PHPUnit
php artisan pest                     # Run with Pest framework
```

### Database Operations
```bash
# Fresh migration with seeding
php artisan migrate:fresh --seed

# Database seeding only
php artisan db:seed

# Check migration status
php artisan migrate:status
```

### Media Library Management
```bash
# Clean deprecated media files
php artisan media-library:clean

# Regenerate media conversions
php artisan media-library:regenerate

# Restore test media files
php artisan media:restore-test
```

### Custom Commands
```bash
# Fix blog images (custom command)
php artisan app:fix-blog-images

# Sync RBAC permissions
php artisan app:rbac-sync

# Permission management
php artisan permission:create-permission "permission name"
php artisan permission:create-role "role name"
php artisan permission:show
```

### Cache Management
```bash
# Clear all caches
php artisan optimize:clear

# Cache for production
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Architecture & Code Organization

### Layered Architecture
The application follows a layered architecture pattern:

**Presentation Layer:** Blade templates with multi-language support (EN/UR)
**Application Layer:** Controllers organized by domain (CMS, CRM, Frontend), middleware, and services  
**Domain Layer:** Eloquent models, policies, traits, and business logic
**Infrastructure Layer:** Database, file storage, and external services

### Module Structure
The codebase is organized into three main domains:

**1. CMS (Content Management System) - `/app/Http/Controllers/Cms/`**
- Page Management (`CmsPageController`)
- Blog System (`BlogController`, `BlogCategoryController`, `BlogTagController`, `BlogCommentController`)
- Slider Management (`SliderController`)
- Tender Management (`TenderController`)

**2. CRM (Customer Relationship Management) - `/app/Http/Controllers/Crm/`**
- Hatchery Management (`HatcheryController`)
- Fish & Seed Selling (`FishSellingController`, `SeedSellingController`)
- Stocking Operations (`PublicStockingController`, `PrivateStockingController`)
- Brood Production (`BroodProductionController`)
- Target Management (`TargetController`)

**3. Frontend - `/app/Http/Controllers/Frontend/`**
- Public website (`FrontendController`)
- Dynamic pages, blog, tenders, contact functionality

### Key Services & Traits
- **MediaLibraryService:** Handles WordPress-like media management with responsive images
- **HasOrgScope Trait:** Organization-scoped data access
- **ResponsiveImageHelper Trait:** Image handling utilities

### Middleware
- **SetLocale:** Multi-language support (EN/UR)
- **ApplyOrgScope:** Organization-level data isolation
- **Authentication & Authorization:** Role-based access control

## Database Schema Patterns

### Key Relationships
- **Users:** Staff with roles and organizational scope
- **Organization Units:** Hierarchical structure with `org_units` and `org_unit_edges`
- **Content:** Pages, blog posts with categories/tags, sliders, media gallery
- **Business Data:** Hatcheries, fish/seed selling records, stocking operations
- **RBAC:** Using Spatie Laravel Permission tables

### Important Tables
- `users` (staff_id, designation, org-scoped)
- `org_units` (hierarchical organization structure)
- `hatcheries`, `fish_sellings`, `seed_sellings` (business operations)
- `pages`, `blog_posts`, `galleries` (content management)
- `roles`, `permissions`, `model_has_roles` (access control)

## Development Guidelines

### Testing Strategy
- Tests are configured to use Pest PHP framework
- In-memory SQLite database for testing
- Feature tests for CMS/CRM operations
- Unit tests for business logic

### File Upload & Media Management
The system uses Spatie Media Library with WordPress-like functionality:
- Access media library at `/cms/media-library`
- Automatic responsive image generation (thumbnail, small, medium, large, hero, etc.)
- Gallery management with public/private visibility
- Use `<x-responsive-image>` component for responsive images

### Multi-language Support
- Locale switching via `SetLocale` middleware
- Currently supports EN/UR (English/Urdu)
- Dynamic content localization ready

### Authentication & Authorization  
- Role-based access control using Spatie Laravel Permission
- Hierarchical permissions system
- Organization-scoped data access
- Default roles: admin, staff, viewer

### Frontend Integration
- TailwindCSS for styling with custom configuration
- Alpine.js for interactive components
- Axios for AJAX requests
- Vite for modern asset compilation

### API Integration (Future)
The system is API-ready with:
- Laravel Sanctum for token authentication
- Resource classes for API responses
- Structured for future mobile app integration

### Performance Considerations
- Queue processing for media conversions
- Eager loading to prevent N+1 queries
- Route caching for production
- Redis integration ready for sessions/cache

## Common Patterns & Commands

### Creating New Modules
When adding new CRM/CMS modules:
```bash
# Create controller in appropriate namespace
php artisan make:controller Crm/NewModuleController --resource

# Create model with factory and migration  
php artisan make:model NewModule -mf

# Create form requests
php artisan make:request StoreNewModuleRequest
php artisan make:request UpdateNewModuleRequest

# Create policy
php artisan make:policy NewModulePolicy --model=NewModule
```

### Adding New Media Collections
For new media types, define in your model:
```php
public function registerMediaCollections(): void
{
    $this->addMediaCollection('new_collection')
        ->acceptsMimeTypes(['image/jpeg', 'image/png'])
        ->useDisk('public');
}
```

### Working with Permissions
```bash
# Create permissions for new modules
php artisan permission:create-permission "view new-module"
php artisan permission:create-permission "create new-module" 
php artisan permission:create-permission "edit new-module"
php artisan permission:create-permission "delete new-module"

# Sync RBAC system
php artisan app:rbac-sync
```

### Environment Configuration

**Required API Keys (if using AI features):**
```env
HUGGINGFACE_API_TOKEN=hf_xxx
HUGGINGFACE_MODEL_ID=KurmaAI/AQUA-7B
# OpenAI and DeepSeek AI also supported
```

**Database Configuration:**
Supports SQLite (development), MySQL, and PostgreSQL with optional PostGIS for GIS features.

**File Storage:**
Configured for local storage with S3-ready setup for production scaling.

## Project Status & Next Steps

**Current Completion:** ~85%
**Key Features Implemented:** ✅ Complete CRUD operations, ✅ Media management, ✅ RBAC, ✅ Multi-language support, ✅ Responsive design

**Recommended Improvements:**
- Implement Repository Pattern for data access
- Add comprehensive API documentation
- Enhanced error handling and logging
- Performance monitoring integration
- Advanced analytics and reporting features