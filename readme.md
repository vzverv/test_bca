#Test task for BCA

# index.php

I like to keep the entry point clean, so I moved routes to a dedicated file in config

#Controllers
I use invokable controllers - they have only one function: link request, business logic and response.
Each controller has only one responsibility.

#Persistence layer

I separate read and write models to respect CQRS principle.
Write models should be accessed via a service from the app layer (UseCase), at the same time the read model usually 
doesn't need to process data - it simply retrieves it from the data storage. 

#Because it is a test task I skipped some moments: 
- I do not implement PSR7 interfaces