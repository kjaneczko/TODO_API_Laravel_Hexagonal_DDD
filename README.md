# Todo App — Hexagonal Architecture & DDD (PHP / Laravel)

This project is a simple **Todo application** built as a **learning and portfolio project**, with a strong focus on **clean architecture, Domain-Driven Design (DDD)** and **SOLID principles**.

The goal of this project is not feature richness, but **clean separation of concerns**, clear domain boundaries, and testable business logic.

---

## Key architectural decisions
### Hexagonal Architecture (Ports & Adapters)
The application is structured around the hexagonal architecture pattern:

- **Domain**
  - Pure domain logic (entities, value objects, domain validation)
  - No dependencies on framework, HTTP, ORM or infrastructure
- **Architecture**
  - Use cases and architecture/application services 
  - Cross-aggregate rules (e.g. validating references between Task and TaskList)
  - Orchestration logic
- **Infrastructure**
  - Eloquent repositories (database adapters)
  - Persistence mappers
- **HTTP layer**
  - Thin controllers 
  - Request validation 
  - JSON resources and exception mapping

Dependencies always point **inward**, towards the domain.

---

### Domain-Driven Design
The core domain concepts are:

- **Task**
  - Represents a single todo item 
  - Uses a value object (`TaskId`)
  - Domain-level validation (name, position, state)

- **TaskList**
  - Represents a logical grouping of tasks 
  - Uses a value object (`TaskListId`)
  - Acts as a separate aggregate root

`Task` and `TaskList` are modeled as **separate aggregates**.
Cross-aggregate rules (e.g. assigning a task to a list, creating a task in a list) are handled in the **architecture layer**, not inside entities.

---

### Validation strategy

Validation is handled on two levels:

1. **HTTP request validation**
    - Ensures correct input shape and types
2. **Domain validation**
    - Enforces business rules inside entities
    - Implemented using domain-specific validation exceptions

Both validations return the same JSON format:
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "field": ["error message"]
  }
}
```

This keeps the domain clean while providing a consistent API.

---

### Task querying & filtering

Task listing is implemented using:
- `TaskListId` — domain filter (VO)
- `PageRequest` — pagination and sorting options

At this stage, there is only one filter (`TaskListId`), so I did not introduce a separate Criteria/Options VO. If the number of filters increased, the natural refactor would be to add `TaskCriteria`.

---

## Testing

The project includes **feature tests** covering:
 - CRUD operations for Tasks and TaskLists
 - Negative scenarios (404, validation errors)
 - Cross-aggregate rules (e.g. creating a task for a non-existing list)
 - Cascade deletion (deleting a list removes its tasks)

Tests are written to validate **behavior**, not implementation details.

---

## API overview (examples)

- `GET /api/tasks`
- `POST /api/tasks`
- `PATCH /api/tasks/{id}`
- `DELETE /api/tasks/{id}`
- `GET /api/task-lists`
- `POST /api/task-lists`
- `GET /api/task-lists/{id}`
- `DELETE /api/task-lists/{id}`
- `GET /api/task-lists/{id}/tasks`
- `POST /api/task-lists/{id}/tasks`

--- 

## API documentation (Postman)

The repository includes a Postman collection located in the `docs/` directory.

It contains all available API endpoints and can be used to manually test the API without reading the source code.

The collection allows quick exploration of the API and manual verification of request/response behavior.

---

## Why this project?

This project demonstrates:
- Understanding of **clean architecture principles**
- Practical application of **DDD concepts**
- Ability to design **testable, maintainable code**
- Conscious trade-offs between purity and pragmatism
It was built intentionally as a **portfolio project**, focusing on code quality and architectural clarity rather than production-scale optimizations.

---

## Tech stack

- PHP 8.x
- Laravel
- MySQL
- PHPUnit / Pest
- REST API (JSON)

---

## Running the project
```bash
composer install
php artisan migrate
php artisan test
php artisan serve
```

--- 

## Final note

This project is intentionally kept small to clearly showcase architectural decisions and domain modeling, without unnecessary complexity.


