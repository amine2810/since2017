              <div class="sidebar-box p-4 about text-center ftco-animate">
                <h2 class="heading mb-4">A propos de moi</h2>
                <img src="images/eya.jpg" class="img-fluid" alt="Colorlib Template">
                <div class="text pt-4">
                  <p>Salut! Je m'appelle <strong>Eya Smiri</strong>, Bienvenue! Retrouvez Mes recettes testées et Approuvées sur le Blog et Mes contacts INSTAGRAM & FACEBOOK ci-dessous! </p>
                </div>
             <div class="col-lg-6">
                <div class="btn__container1 ">
                  <a href="https://www.instagram.com/eyasmiri/" target="_blank" class="btn123 btn12345">
                    <i class="fab fa-instagram" id="btn-f" style="margin-left: 15px;"></i>
                    <span id="btn-fs">instagram</span>
                  </a> <br>
                    <a href="#" class="btn-f btn-f2">
                    <i class="fab fa-facebook" id="btn-f" style="margin-left: 15px"></i>
                    <span id="btn-fs">facebook</span>
                  </a>
                </div>
              </div><br> 
                <div style="margin-top: 120px;" class="form-group">
                    <p class="mb-0"><a href="contact.php" class="btn btn-black py-2">Vous avez des questions?</a>
                    </p>
                    </div>
              </div>
           <div class="sidebar-box categories text-center ftco-animate">
                <h2 class="heading mb-4">Categories</h2>
                <ul class="category-image">
                   <?php
                    $req="select * from categories LIMIT 3";  
            $res = mysqli_query($connect,$req);
                    while ($rec = mysqli_fetch_array($res)) :
                          
                        ?>
                  <li>
                    <a href="#" class="img d-flex align-items-center justify-content-center text-center" style="background-image: url(<?php echo "../Admin/".$rec['image']; ?>);">
                      <div class="text">
                        <h1 style="color: #fff"><?php echo $rec['categorie']; ?></h1>
                      </div>
                    </a>
                  </li>
                  <?php
                    endwhile; 
                  ?>
                </ul>
              </div>
            </div>