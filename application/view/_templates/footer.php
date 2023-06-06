<style>
            .navFooter{
               display: flex;
               justify-content: start;
               margin-left: 20px;
               word-spacing: normal;
            }

            .navFooter div{
               margin-left: 6px;


            }
        </style>
        <div class="footer"></div>
        </div><!-- close class="wrapper" -->
            <nav class="navFooter">
                  <div>
                     <a href="<?= Config::get("URL") . "imprint/index" ?>">Imprint</a>
                  </div>
           <div>
              <a href="<?= Config::get("URL") . "clientPrivacy/index" ?>">Privacy</a>
           </div>
        </nav>
        </body>
        </html>