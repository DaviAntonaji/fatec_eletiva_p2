            <nav id="mainnav-container">
                <div id="mainnav">


                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">

                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap text-center">
                                        <div class="pad-btm">
                                            <img class="img-circle img-md" src="<?=$_SESSION["user_data"]["user_photo"]?>" alt="Profile Picture">
                                        </div>
                                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <p class="mnp-name"><?=$_SESSION["user_data"]["user_name"]?></p>
                                            
                                        </a>
                                    </div>
                                   
                                </div>


                                


                                <ul id="mainnav-menu" class="list-group">
						
                                  
						
						            <li>
						                <a href="painel.php">
						                    <i class="pli-alarm-clock"></i>
						                    <span class="menu-title">Agenda</span>
						                </a>
						            </li>
						            <li class="list-divider"></li>
						
						            <li>
						                <a href="clientes.php">
						                    <i class="pli-male"></i>
						                    <span class="menu-title">
												Clientes
											</span>
						                </a>
						            </li>

                                    
						            <li>
						                <a href="imoveis.php">
						                    <i class="pli-office"></i>
						                    <span class="menu-title">
												Imóveis
											</span>
						                </a>
						            </li>
						
						
						

                                </ul>


                                

                            </div>
                        </div>
                    </div>

                </div>
            </nav>