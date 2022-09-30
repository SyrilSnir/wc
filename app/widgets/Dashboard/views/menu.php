<?php 
use yii\helpers\Url;

?>

      <li class="nav-item">

        <a href="/" class="nav-link d-flex align-items-center">
          <span class="sidebar-icon">
            <img src="/build/images/logo.png" alt="WantCan logo" height="20" width="20" alt="WantCan logo">
          </span>
          <span class="mt-1 ms-1 sidebar-text">WantCan панель</span>
        </a>
      </li>
<?php
/** @var array $items */
$subMenuId = 1;
 foreach ($items as $item): ?>
      <li class="nav-item">
              <?php if (!key_exists('items', $item)): ?>
          <a href="<?php echo Url::toRoute($item['url']) ?>" target="_blank" class="nav-link d-flex justify-content-between">
          <span>
            <span class="sidebar-icon">
              <i class="fa-solid fa-<?php echo $item['icon'] ?>"></i>
            </span>
              <span class="sidebar-text"><?php echo $item['label'] ?></span>
          </span>
        </a>
                  <?php else: ?>
<li class="nav-item">
        <span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-app" aria-expanded="true">
          <span>
            <span class="sidebar-icon">
              <i class="fa-solid fa-<?php echo $item['icon'] ?>"></i>
            </span> 
              <span class="sidebar-text"><?php echo $item['label'] ?></span>
          </span>
          <span class="link-arrow">
            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
          </span>
        </span>
        <div class="multi-level collapse" role="list" id="submenu-app" aria-expanded="false" style="">
          <ul class="flex-column nav">
               <?php foreach ($item['items'] as $subElement): ?>
            <li class="nav-item ">
              <a class="nav-link" href="<?php echo Url::toRoute($subElement['url']) ?>">              
                  <span class="sidebar-text"><?php echo $subElement['label'] ?></span>
              </a>
            </li>
                  <?php endforeach; ?>
          </ul>
        </div>
      </li>          
                  <?php endif; ?>
          
      </li>        
<?php endforeach; ?>

