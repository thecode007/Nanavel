# Nanavel
Nanavel is a Rest APi framework built for fun to mimic the Laravel framework the Sakila database is used for the sake of example.

# Patterns and Concepts
  - Other than the regular OOP concepts and MVC, the factory pattern is used in ControllerFactory.
  - String dependency injections is used in Request which parsed by regular expression to match the
    right URL.
  - Reflection is used to match naming convention in model and controller that matched the table name
    in the databse.
