
## PUPQC Alumni Portal 
### Version 1.0 Updates

#### feature/system_administrator (Updates)
1. Database migrations are updated based on the latest data dictionary (version 2.1)
   - .sql file of the database is included in this branch
   - data dictionary .docx file v2.1 is included in this branch
2. Create API controllers and repositories for system admin sub-modules:
       * - Course Management
       * - Account Type Management
       * - Post Type Management
       * - Educational Attainment Management
       * - Honors Received Management
       * - Professional Exam Management
       * - First Job Timeframe Management
       * - First Job Discover Management
       * - Job Level Management
       * - Self Employed Salary Management
       * - Unemployment Reason Management
       * - Industry Management
       * - Competency Management
       * - Impact of Education Management
3. Created a guzzle request library for the front and admin controllers
4. Created a single hub controller for system admin processes in admin component
5. API and Admin routes are updated.
6. Created a logging system for both API and Admin components (Config and Library)
   NOTE: Change the value of your .env key "LOG_CHANNEL" to "daily".

Also, don't forget to run composer update.
