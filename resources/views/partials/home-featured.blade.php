<section class="section">

    <h2>Ebook nổi bật</h2>

    <div class="book-grid">

        @for($i = 1; $i <= 10; $i++)

            <div class="book-card">

                <div class="book-cover">
                    {{ $i }}
                </div>

                <div class="book-info">
                    <h3>Sách test {{ $i }}</h3>
                    <p>Tác giả test</p>
                </div>

            </div>

        @endfor

    </div>

</section>

<style>

.section{
    padding:40px;
}

.section h2{
    color:#fff;
    font-size:28px;
    margin-bottom:25px;
}

.book-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:20px;
}

.book-card{
    background:#0d121c;
    border-radius:14px;
    overflow:hidden;
    transition:.2s;
}

.book-card:hover{
    transform:translateY(-4px);
}

.book-cover{
    height:260px;
    background:#182131;
    color:#16d6a5;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:60px;
    font-weight:900;
}

.book-info{
    padding:15px;
}

.book-info h3{
    color:#fff;
    font-size:16px;
    margin-bottom:8px;
}

.book-info p{
    color:#94a3b8;
    font-size:14px;
}

@media(max-width:1200px){
    .book-grid{
        grid-template-columns:repeat(4,1fr);
    }
}

@media(max-width:900px){
    .book-grid{
        grid-template-columns:repeat(3,1fr);
    }
}

@media(max-width:600px){
    .book-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

</style>