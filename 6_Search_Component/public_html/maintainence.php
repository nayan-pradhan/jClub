    <?php

    include_once 'head.php';

    ?>
    <link rel="stylesheet" href="css/maintain.css">
    <?php

    include_once 'nav.php';

    ?>

    <section class="maintainancePageLanding">
        <h1>Maintainance Page</h1>
        <ul class="dot">
            <li> <a href="signlog.php">SignUp Page </a>
            <ul class="dot">
                    <li>Entities: Student, Account, Permission</li>
                    <li>Relationship: Manages, Holds</li>
                </ul>
            </li>
            <li> <a href="createclub.php">Create Club Page </a>
            <ul class="dot">
                    <li>Entities: Club, Account, Permission, Activity</li>
                    <li>Relationship: Manages, Holds, Organizes</li>
                </ul>
            </li>
            <li> <a href="#">Register for club (For this you MUST be logged in as a student) </a>
            <ul class="dot">
                    <li>Entities: Member (aggregated entity)</li>
                    <li>Relationship: Has, Register</li>
                </ul>
            </li>
            <li> <a href="#">Add an Acticity (For this you MUST be logged in as a club) </a>
            <ul class="dot">
                    <li>Entities: Activity</li>
                    <li>Relationship: Organizes</li>
                </ul>
            </li>
        </ul>

        <a href="index.php">
            <button class="edit-btn" name="button">Back</button>
        </a>
    </section>

    <?php

    include_once 'footer.php';

    ?>