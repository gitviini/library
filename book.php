<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Jaqueira</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="./bookiconpixel.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
</head>
<body>
<header>
    <nav>
        <ul>
            <li id="logo"><a href="./index.html"><img src="./bookiconpixel.png" alt=""></a></li>
            <li id="letter"><span>Library Jaqueira</span></li>
        </ul>
    </nav>
</header>
<main>
    <div id="form">
        <a id="new_book"><button>Novo book</button></a>
        <form action="./book.php" method="post">
            <input type="text" name="title" required placeholder="Título">
            <label for="img">Foto</label>
            <input type="file" name="img" id="img">
            <input type="text" name="auth" required placeholder="Autor">
            <input type="text" name="description" placeholder="Descrição">
            <button>enviar</button>
        </form>
    </div>
    <section id="books_container">
        <h2>books</h2>
        <div id="books">
            <div class="book">
                <img src="./codigo.jpg" alt="">
                <p>O código davinci</p>
            </div>
            <div class="book">
                <img src="./dom_casmurro.jpg" alt="">
                <p>Dom casmurro</p>
            </div>
        </div>
    </section>
</main>
</body>
<script>
    const color = new ColorThief();
    const new_book = document.querySelector('#new_book')
    const form = document.querySelector('form')
    const books = document.querySelectorAll('.book')
    let msg = document.createElement('span')
    new_book.appendChild(msg)
    new_book.onclick = () =>{
        form.classList.toggle('click')
        new_book.classList.toggle('click')
        if(new_book.classList['value'] == 'click'){
            new_book.children[0].innerHTML = 'x'
            msg.innerHTML = 'Novo book'
        }
        else{
            new_book.children[0].innerHTML = 'Novo book'
            msg.innerHTML = ''
        }
    }

    books.forEach(async book=>{
        try{
            let color_book = await color.getColor(book.children[0])
            let palette_book = await color.getPalette(book.children[0])
            book.children[0].style.outline = `2px solid rgba(${palette_book[1][0]},${palette_book[1][1]},${palette_book[1][2]},1)`
            //book.children[0].style.borderBottom = `10px solid rgba(${palette_book[1][0]},${palette_book[1][1]},${palette_book[1][2]},1)`
            //book.children[0].style.borderRight = `10px solid rgba(${palette_book[1][0]},${palette_book[1][1]},${palette_book[1][2]},1)`
            console.log(color_book)
        }
        catch(err){console.log(err)}
    })
</script>
</html>
<?php 
    function insert(object $con,array $array=[]):void{
        $res = $con->query("INSERT INTO book(title, auth, description) VALUES('$array[0]','$array[2]','$array[3]')");

        if($res){echo "livro $array[0] inserido com suceeso";}
        else{echo "falha ao adicionar o livro $array[0]";}

        header("Refresh:1");
    }

    function upload(object $con,array $array=[]):void{
    }

    function connect(){
        try{
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db = 'library';
            $con = mysqli_connect($host, $user, $pass, $db);   

            if($con->connect_error){
                echo ''. $con->connect_error;
            }
            return $con;
        }
        catch(Exception $err){
            echo $err;
        }
    }

    function generate(array $array):void{
        
    }

    function get_all(object $con):array{
        $sql = 'SELECT * FROM book';
        $result = $con->query($sql)->fetch_all();

        return $result;
    }

    $con = connect();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        echo 'enviou';
    }
?>
