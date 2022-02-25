Mosahebe App

usage of mosahebe api
     Mosahebe Routes:


     /show :for see all mosahebes(get)

    /mosahebe/show/{id}: for show a mosahebe's detail(get) 

    /mosahebe/create: for creating mosahebe(post)

    data required: 1.title 2.detail 3.date

    /mosahebe/update/{id}: for updating mosahebe(post)

    data required(one of them are required): 1.title 2.detail 3.date

/mosahebe/delete/{id}: for delete mosahabe


Auth User:

/user/logout: for logout user(post)

/user/register: for registering user(post)

data required: 1.name 2.email 3.password 4.password_confirmation

        /user/login: for login user(post)

        data required:1.email 2.password

        ";
