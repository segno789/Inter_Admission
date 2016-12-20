<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Quick Access
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="row-fluid">
                            <div class="metro-nav">
                                <div class="metro-nav-block nav-block-yellow current">
                                    <a href="" >
                                        <div class="fs1" aria-hidden="true" data-icon="&#xe0a0;"></div>
                                        <div class="brand">
                                            Main Dashboard
                                        </div>
                                    </a>
                                </div>
                                <div class="metro-nav-block nav-block-orange">
                                    <form action="http://registration.bisegrw.com/login" id="regform" method="post" target="_blank">
                                        <input type="hidden" type="hidden" name="username" id='username' value="<?=  $Inst_Id?>">
                                        <input type="hidden" type="hidden" name="password" id='password' value="<?= $pass?>">
                                        <a  target="_blank" onclick="document.getElementById('regform').submit();" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe024;"></div>
                                            <div class="brand">
                                                11th Resgitration
                                            </div>
                                        </a>
                                    </form>
                                </div>
                                <!-- <div class="metro-nav-block nav-block-blue double">
                                <form action="http://hssc.bisegrw.com/login" id="adm9form" method="post" target="_blank">
                                <input type="hidden" type="hidden" name="username" id='username' value="<?=  $Inst_Id?>">
                                <input type="hidden" type="hidden" name="password" id='password' value="<?= $pass?>">
                                <a  target="_blank" onclick="document.getElementById('adm9form').submit();" >
                                <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                                <div class="brand">
                                11th Admission
                                </div>
                                </a>
                                </form>
                                </div>       -->
                                <div class="metro-nav-block nav-block-red">
                                    <form action="http://slips.bisegrw.com/" id="slips9thform" method="post" target="_blank">
                                        <input type="hidden" type="hidden" name="username" id='username' value="<?=  $Inst_Id?>">
                                        <input type="hidden" type="hidden" name="password" id='password' value="<?= $pass?>">
                                        <a  target="_blank" onclick="document.getElementById('slips9thform').submit();" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe05c;"></div>
                                            <div class="brand">
                                                11th Roll Number Slips
                                            </div>
                                        </a>
                                    </form>
                                </div>
                                <div class="metro-nav-block nav-block-green">
                                    <form action="http://results.bisegrw.com/" id="res9form" method="post" target="_blank">
                                        <input type="hidden" type="hidden" name="username" id='username' value="<?=  $Inst_Id?>">
                                        <input type="hidden" type="hidden" name="password" id='password' value="<?= $pass?>">
                                        <a  target="_blank" onclick="document.getElementById('res9form').submit();" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe05c;"></div>
                                            <div class="brand">
                                                11th Result Cards
                                            </div>
                                        </a>
                                    </form>
                                </div>
                                <div class="metro-nav-block nav-block-green">


                                    <form action="<?php  echo base_url(); ?>/index.php/Admission_inter" id="adm10form" method="post" target="_blank">
                                        <input type="hidden" type="hidden" name="username" id='username' value="<?=  $Inst_Id?>">
                                        <input type="hidden" type="hidden" name="password" id='password' value="<?= $pass?>">
                                        <a  target="_blank" onclick="document.getElementById('adm10form').submit();" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                                            <div class="brand">
                                                12th Admission
                                            </div>
                                        </a>
                                    </form>
                                </div>

                                <div class="metro-nav-block nav-block-red double">
                                    <form action="http://slips.bisegrw.com/" id="slip10form" method="post" target="_blank">
                                        <input type="hidden" type="hidden" name="username" id='username' value="<?=  $Inst_Id?>">
                                        <input type="hidden" type="hidden" name="password" id='password' value="<?= $pass?>">
                                        <a  target="_blank" onclick="document.getElementById('slip10form').submit();" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe05c;"></div>
                                            <div class="brand">
                                                12th Roll Number Slips
                                            </div>
                                        </a>
                                    </form>
                                </div>

                                <div class="metro-nav-block nav-block-blue">
                                    <form action="http://results.bisegrw.com/" id="res10form" method="post" target="_blank">
                                        <input type="hidden" type="hidden" name="username" id='username' value="<?=  $Inst_Id?>">
                                        <input type="hidden" type="hidden" name="password" id='password' value="<?= $pass?>">
                                        <a  target="_blank" onclick="document.getElementById('res10form').submit();" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe05c;"></div>
                                            <div class="brand">
                                                12th Result Cards
                                            </div>
                                        </a>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>