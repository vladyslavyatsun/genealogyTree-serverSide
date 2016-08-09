get     /api/trees - возвращает все деревья, находящиеся в базе данных
Пример полученного JSON
[{"d":"4","title":"tree1", "author":"none", "number_of_persons":15},{"tree_id":"5","title":"untitled","author":"none","number_of_persons":8},{"tree_id":"6","title":"123123","author":"none","number_of_persons":31},{"tree_id":"7","title":"untitled","author":"none","number_of_persons":5},{"tree_id":"12","title":"untitled","author":"none","number_of_persons":5}]

get     /api/persons/tree/tree_id - tree_id - параметр; запрос возвращает все персоны, находящиеся в дереве с id = tree_id
Пример полученного JSON
[{"person_id":"45","first_name":"rt","middle_name":"Unnamed","last_name":"Unnamed","gender":"female","tree_id":"12","father_id":"0","mother_id":"47"}]

get     /api/person/person_id - возвращает персону по ее id
Пример полученного JSON
{
   
    {
        "id": "45",
        "firstName": "rt",
        "middleName": "Unnamed",
        "lastName": "Unnamed",
        "gender": "female",
        "tree_id": "12",
        "father_id": "0",
        "mother_id": "47"
    }
}

post    /api/tree - добавляет новое дерево со значениями по умолчанию
Пример входного JSON
{
    {
        "title": "untitled",
        "author": "none"
    }
}

post    /api/person - возвращает персону со значениями по умолчанию
Пример входного JSON
{"tree_id":"4"}

Пример выходного JSON
{

    {
        "id": "101",
        "firstName": "Unnamed",
        "middleName": "Unnamed",
        "lastName": "Unnamed",
        "gender": "1",
        "tree_id": "4",
        "father_id": null,
        "mother_id": null
    }
}

delete  /api/trees/tree_id - удаляет дерево по его id
Пример возвращаемого JSON 
respons code = 204

delete  /api/persons/person_id - удаляет персону по id
Пример выходного JSON аналогичен предыдущему запросу
respons code = 204

put     /api/trees/tree_id - обновляет дерево
Пример входного JSON
{"title":"test", "author":"test"}


put     /api/persons/person_id - обновляет персону
Пример входного JSON
{
    "firstName":"test", 
    "middleName":"test",
    "lastName":"test",
    "gender":"1", 
    "mother_id":"3", 
    "father_id":"2"
}

