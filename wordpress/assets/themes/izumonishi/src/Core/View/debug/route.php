<?php declare(strict_types=1); ?>
<?php global $mvc4wp_debug; ?>
<div class='expand-containers'>
    <?php if (array_key_exists('route', $mvc4wp_debug) && !empty($mvc4wp_debug['route'])): ?>
        <?php $route = $mvc4wp_debug['route'][0]; ?>
        <h3 class='name debug-cyan'>
            <?php eh(sprintf("%s: %s", $route['method'], $route['uri'])); ?>
        </h3>
        <p class='value'>
            <span class='debug-green'>
                <?php if (empty($route['route']->signature)): ?>
                    <?php eh(sprintf('%d: %s', $route['route']->status->value, $route['route']->status->name)); ?>
                <?php else: ?>
                    <?php eh($route['route']->signature); ?>
                <?php endif; ?>
            </span>
        <pre class='debug-green'><?php eh(print_r($route['route']->args, true)); ?></pre>
        </p>
        <div class='expand-container'>
            <input type='checkbox' id='debug-route-routes-toggle' class='checkbox'>
            <label for='debug-route-routes-toggle' class='label debug-clickable'>
                <h4><i class="icon-plus"></i>ALL Routes</h4>
            </label>
            <div class='expandable'>
                <?php foreach ($route['routes'] as $k => $v): ?>
                    <p>
                        <span class='name debug-cyan'>
                            <?php eh(implode(':&nbsp;', explode('`', $k))); ?>
                        </span>
                        <span class='value debug-green'>
                            <?php eh($v); ?>
                        </span>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>