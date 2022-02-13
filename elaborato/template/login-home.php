<div class=" p-5 bg-image text-white rounded-2">
    <h2 class="display-2" >Welcome <?php echo $_SESSION["Nome"]; echo " ".$_SESSION["Cognome"]; ?></h2>
    <p>We are glad to see you here</p>
</div>
<section class="container mt-5">
    <?php if($templateParams["isAdmin"]): ?>
        <div class="row mt-5">
            <div class="text-center">
                <a href="manage-products.php" class="btn btn-block bg-dark " type="submit">Add Products</a>
            </div>
        </div>
    <?php else :  ?>
    <div class="row mt-5">
        <header>
            <h3>Your Orders</h3>
        </header>
        <section class="overflow-auto mt-0">
            Tutti gli ordini
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus accusantium molestiae non corporis eum ab rem id praesentium, distinctio exercitationem, voluptate laborum ipsam vitae nemo sit expedita officia debitis sapiente.
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nostrum quod sed maxime, praesentium sit quam exercitationem vero aliquam beatae minus magnam amet nobis dignissimos tenetur atque aperiam id ducimus consequuntur.
            Cumque debitis dignissimos pariatur, voluptate qui id unde nam at repellat atque quibusdam, sed illo dolore necessitatibus fugiat soluta in! Eius maiores porro tempore autem! Molestias totam quos nemo asperiores.
            Ipsa itaque laboriosam omnis possimus. Sint itaque quas accusamus numquam, deleniti earum consequuntur, odio minus vitae et ea? Placeat dolorum temporibus enim tempora repellendus distinctio voluptatem modi voluptatum obcaecati asperiores.
            Sequi iure eaque illo sint cumque non, id odit, ipsa temporibus beatae laudantium quo commodi nulla quasi aut facilis explicabo? Deserunt ratione aut praesentium ad earum. Minus incidunt omnis impedit?
            Dolorum, vel! Soluta nam, explicabo optio excepturi odit a, numquam omnis quidem quos quisquam est eos ducimus in voluptate aspernatur sunt suscipit dolorem nisi cum. Corrupti fuga distinctio aut id?
            Molestias corrupti, animi quasi veniam accusantium sunt alias nisi, ut eum provident assumenda deleniti fuga laboriosam. Praesentium repellat possimus ad mollitia maxime aliquid quaerat dolores. Nam tempora minus cupiditate assumenda?
            Modi accusantium corporis quia non labore ex minima reprehenderit tenetur, dolorum explicabo deserunt praesentium excepturi, impedit deleniti, quasi quisquam voluptatum temporibus ipsum eum dolore accusamus inventore placeat iure. Totam, natus.
            Nemo rerum itaque quas et commodi, enim quae veritatis adipisci amet. Consequuntur neque, iste rem rerum iusto, minus laboriosam porro velit doloribus beatae temporibus repudiandae ut inventore tenetur, accusantium error.
            Beatae corrupti dolorum perferendis cupiditate natus saepe ratione animi voluptas quia quod, quas inventore. Voluptatum fugiat ipsa, mollitia saepe blanditiis corrupti explicabo deserunt ullam quam deleniti voluptas earum dolores quas!
            Recusandae vitae nihil rem autem cum voluptatibus provident quidem laborum, architecto rerum labore ipsum nostrum minus dolor sequi temporibus itaque vero dolorem quaerat esse inventore repudiandae atque sit? Fuga, nihil?
        </section>
    </div>
    <?php endif;  ?>
    <div class="row">
        <div class="mb-3 text-center">
            <a href="index.php" class="btn btn-block bg-dark " id="logoutButton" type="submit"  >Logout</a>
        </div>
    </div>
    
</section>