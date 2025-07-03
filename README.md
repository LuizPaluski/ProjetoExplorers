Projeto explorer, usei api de localizacao para facilitar.
json:
{
    "address": "Cristo Redentor, Rio de Janeiro, Brasil"
}

colocando isso quando voce se registra ele puxa automaticmanete
a latitude e a longitude.




Para fazer trade passe um array e coloque o id do item dentro
ex {
"explorer1_id": 1,
"explorer2_id": 2,
"explorer1_items": [1],
"explorer2_items": [2]
}
nomes de items podem gerar bugs pq um item pode ter o mesmo nome porem valorez diferentes
igual items com raridades, isso previne que a troca sempre aconteca sem erros
