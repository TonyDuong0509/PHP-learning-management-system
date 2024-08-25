<?php require ABSPATH . 'resources/instructor/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/instructor/layout/header.php'; ?>

<?php
$router = $router;
?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="chat-wrapper">
            <div class="chat-sidebar">
                <div class="chat-sidebar-header">
                    <div class="d-flex align-items-center">
                        <div class="chat-user-online">
                            <img src="<?php echo $instructor->getPhoto() ?? '/public/upload/no_image.png'; ?>" width="45" height="45" class="rounded-circle" alt="" />
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <p class="mb-0"><?php echo $instructor->getName(); ?></p>
                        </div>
                        <div class="dropdown">
                            <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3"></div>
                    <div class="input-group input-group-sm"> <span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
                        <input type="text" class="form-control" placeholder="People, groups, & messages"> <span class="input-group-text bg-transparent"><i class='bx bx-dialpad'></i></span>
                    </div>
                </div>
                <div class="chat-sidebar-content">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-Chats">
                            <div class="p-3">
                            </div>
                            <div class="chat-list">
                                <div class="list-group list-group-flush">
                                    <a href="javascript:;" class="list-group-item">
                                        <div class="d-flex">
                                            <div class="chat-user-online">
                                                <img src="/<?php echo $question->getUser()->getPhoto() ?? 'public/upload/no_image.png'; ?>" width="42" height="42" class="rounded-circle" alt="" />
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h6 class="mb-0 chat-title"><?php echo $question->getUser()->getName(); ?></h6>
                                                <p class="mb-0 chat-msg">Student</p>
                                            </div>
                                            <div class="chat-time"><?php echo $question->getCreatedAt(); ?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-header d-flex align-items-center">
                <div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
                </div>
                <h6><?php echo $question->getCourse()->getName(); ?></h6>
                <div class="chat-top-header-menu ms-auto"> <a href="javascript:;"><i class='bx bx-video'></i></a>
                    <a href="javascript:;"><i class='bx bx-phone'></i></a>
                    <a href="javascript:;"><i class='bx bx-user-plus'></i></a>
                </div>
            </div>
            <div class="chat-content">
                <div class="chat-content-leftside">
                    <div class="d-flex">
                        <img src="/<?php echo $question->getUser()->getPhoto() ?? 'public/upload/no_image.png'; ?>" width="48" height="48" class="rounded-circle" alt="" />
                        <div class="flex-grow-1 ms-2">
                            <p class="mb-0 chat-time"><?php echo $question->getSubject(); ?> / <?php echo $question->getCreatedAt(); ?></p>
                            <p class="chat-left-msg"><?php echo $question->getQuestion(); ?></p>
                        </div>
                    </div>
                </div>
                <?php if (!empty($replay)): ?>
                    <?php foreach ($replay as $rep): ?>
                        <div class="chat-content-rightside">
                            <div class="d-flex ms-auto">
                                <div class="flex-grow-1 me-2">
                                    <p class="mb-0 chat-time text-end"><?php echo $rep->getCreatedAt(); ?></p>
                                    <p class="chat-right-msg"><?php echo $rep->getQuestion(); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <form action="<?php echo $router->generate('instructor.reply'); ?>" method="POST">
                <input type="hidden" name="question_id" value="<?php echo $question->getId(); ?>">
                <input type="hidden" name="course_id" value="<?php echo $question->getCourse()->getId(); ?>">
                <input type="hidden" name="user_id" value="<?php echo $question->getUser()->getId(); ?>">
                <input type="hidden" name="instructor_id" value="<?php echo $instructor->getId(); ?>">
                <div class="chat-footer d-flex align-items-center">
                    <div class="flex-grow-1 pe-2">
                        <div class="input-group"> <span class="input-group-text"><i class='bx bx-smile'></i></span>
                            <input type="text" name="question" class="form-control" placeholder="Type a message">
                        </div>
                    </div>
                    <div class="chat-footer-menu">
                        <button class="btn btn-primary" type="submit"><i class="lni lni-reply"></i>Send</button>
                        <a href="javascript:;"><i class='bx bxs-contact'></i></a>
                        <a href="javascript:;"><i class='bx bx-microphone'></i></a>
                        <a href="javascript:;"><i class='bx bx-dots-horizontal-rounded'></i></a>
                    </div>
                </div>
            </form>
            <div class="overlay chat-toggle-btn-mobile"></div>
        </div>
    </div>
</div>

<?php require ABSPATH . 'resources/instructor/layout/footer.php'; ?>

</div>

<?php require ABSPATH . 'resources/instructor/layout/footerScript.php'; ?>
<script src="<?php ABSPATH ?>/instructor/public/js/app.js"></script>
<script>
    new PerfectScrollbar(".app-container")
</script>
</body>

</html>