ToDo list
=============
Správce úkolů pro jednotlivce. Jedná se o semestrální práci pro předmět Webove Aplikace 1

* Zadání: https://edux.feld.cvut.cz/courses/A7B39WA1/student/kruzimic/start

Funkce
-------------
* Vkládání a správa úkolů obsahující popis, důležitost, datum splnění a další informace
* Úkoly jsou rozděleny do skupin
* Kategorie si vytváří uživatel

Funkce podle rolí
-------------
* Nepřihlášení uživatelé - mohou se pouze přihlásit / registrovat
* Přihlášení uživatelé - mohou spravovat své úkoly a kategorie
* Admin - může navíc mazat uživatele

Instalace
-------------
* Nainstalujte nette 2.0 z webu http://nette.org/cs/download
* Nainstalujte dibi 1.5 do nette z webu http://dibiphp.com/cs/download
* Do rootu instalace zkopírujte projekt ToDo list, který je k dispozici na GitHubu
* Vytořte databázi a spusťte v ní přiložený mysql skript
* Přihlašovací údaje vložte do /app/config.neon
* Přihlašte se jako předpřipravený uživatel (admin) a změňte mu heslo a nebo pomocí něj zvolte jiného uživatele adminem

Status
-------------
Plnohodnotná fungující verze.

TODO
-------------
* http://duke.dynalias.com/ticket/index.php?project=4&do=index&switch=1

Minimální požadavky
-------------
* Database supported by Dibi
*	PHP 5.3 (because of Namespaces)
* PHP configuration listed here http://doc.nette.org/cs/requirements

Vývoj
-------------
Celý web vytvářím sám za pomocí:

* Nette framework
* Dibi database layer

Ostatní
-------------
Vzhledem k minimálnímu požadavku na verzi PHP jsem byl nucen hostovat web u sebe na serveru a vynechat webdev.
Nette framework jsem zvolil díky jeho aktivnímu vývoji a široké české základně. Je navíc celkem populární a jeho znalost by se mi mohla v budoucnu hodit. Navíc sám řeší mnoho otázek bezpečnosti.
Dibi jsem zvolil, protože už s nám mám nějaké zkušenosti a práce s ním mi vyhovuje. Šetří čas a přispívá k přehlednosti a bezpečnosti kódu.

Odkazy
-------------
* http://duke.dynalias.com/ToDo-list/