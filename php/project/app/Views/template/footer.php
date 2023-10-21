<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            .footer {
                padding: 5px;
                position: fixed;
                width: 100%;
                height: 40px;
                bottom: 0;
            }
        </style>
    </head>
    <footer class="footer">
        <div class="footer__container">
            <div class="footer__top">
                <div class="company__info">
                    <span class="copyright">
                        <?php if (date("Y") == '2023') { ?>
                            <p>&copy; <?php echo date("Y"); ?></p>
                        <?php } else { ?>
                            <p>&copy; 2023-<?php echo date("Y"); ?></p>
                        <?php } ?>
                    </span>
                </div>
            </div>
        </div>
    </footer>
</html>