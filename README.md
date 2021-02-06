<img src="./images/logo.sample.png" alt="Logo of the project" align="right">

# Nekons &middot; [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com) [![GitHub license](https://img.shields.io/badge/license-Apatche2.0-blue.svg?style=flat-square)](https://github.com/your/your-project/blob/master/LICENSE)

Типичные доки проекта, написанные вашим покорным слугой

## Документация [![PRs Welcome](https://img.shields.io/badge/version-beta0.1-red.svg?style=flat-square)](http://makeapullrequest.com)

Основная цель документации — обеспечение правильного написания фронта на проект, а правильно он пишется для практичности,
реиспользования и читаемости, а это в свою очередь очень важно, как для сайта, так и для здоровья того, кто писал данный
отрывок кода, так что убедительно прошу придерживаться всему описанному ниже.

Так же хочу сказать, что дизайн-система, которая используется на этом проекте несколько корява, но,
ближайшем будущем это будет исправлено

# Разработка

## Что, где и куда комитить?

В общем, на проекте есть три ветки: master (основная, туда идёт весь проверенный код), 
далее feature (туда идёт новая работающая фича, потом кидаешь пулл и делаешь мёрдж с master веткой, далее в feature ветке будет вестись отладка кода, а потом опять пулл и мёрдж)
и последняя ветка develop (туда идёт весь код находящийся в разработке, кароч разрабатывать надо тут).

## Как писать CSS

> Для начала, думаю можно будет сказать что не нужно использовать НИКАКИХ align="center" и display: block;
поскольку данная комбинация является недопустимой и противоречит концепции приведённой выше

Внизу приведён типичный CSS, который мы используем:

```css
#sign-in .check .checkbox-text {
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
}
```

### Совет №1: Не повторяйтесь

В общем, что я име ввиду, по возможности нужно уменьшать количество повоторений в коде,
поскольку это позволит реиспользовать данный код, и его будет удобнее оптимизировать

Например, внизу описаны три стиля для кнопок:

```css
.primary-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 250px;
    height: 40px;
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
    background: var(--blue);
    color: var(--white);
    border-radius: var(--radius-md);
}

.apply-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 250px;
    height: 40px;
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
    background: var(--green);
    color: var(--white);
    border-radius: var(--radius-md);
}

.delete-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 250px;
    height: 40px;
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
    background: var(--red);
    color: var(--white);
    border-radius: var(--radius-md);
}
```

Такой метод написания кода нежелателен, можно единожды написать общие правила в дополнительном классе,
и потом описать цвета в другие классы, как это сделано ниже:

```css 
.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 250px;
    height: 40px;
    font-size: var(--simple-text);
    font-weight: var(--regular-weight);
    color: var(--white);
    border-radius: var(--radius-md);
} 

.primary-btn {
    background: var(--blue);
}

.apply-btn {
    background: var(--green);
}

.delete-btn {
    background: var(--red);
}
```

Как видно, это способствует отсутствию повторов, снижению количества строк, улучшению читаемости
и даже производительности кода

### Совет №2: Не используйте встроенные стили

Во-первых, используя встроенные стили ты будешь много перезаписывать их.

Во-вторых, это противоречит концепции разделения контента (HTML), дизайна (CSS) и логики (JS), хотя на этой странице данный принцип и нарушен, я написал маленькую JS функцию в HTML

И, в-третьих, это затрудняет поиск нужного тебе стиля в документе, по-этому прислушайся и не делай другим больно.

### Совет №3: Используйте сокращённые варианты записи свойств

Некоторые CSS-свойства, такие как padding, margin и border можно описывать гораздо проще,
применяя сокращенный вариант записи. Также это помогает уменьшить количество строк в правилах

При полном варианте записи CSS-класс выглядит так:

```css

.item {
    margin-left: 20px;
    margin-right: 10px;
    margin-top: 45px;
    margin-bottom: 5px;
    padding-left: 20px;
    padding-right: 10px;
    padding-top: 45px;
    padding-bottom: 5px;
    border-width: 2px;
    border-style: dashed;
    border-color: var(--blue);
}
```

При сокращении так:

```css

.item {
    margin: 45px 10px 5px 2px;
    padding: 45px 10px 5px 2px;
    border: 2px dashed var(--blue);
}
```

### Совет №4: При нужде пишите комментарии
Обычно, при чистом коде комментарии не нужны, но иногда случаются ситуации когда комменты необходимы,
например, если код требует дополнительных объяснений, но не надо с этим перебарщивать

### Совет №5:

В общем, говоря на прямую пиксели — это плохо, но я их всё равно использую,
стоит сказать, что для размера шрифта пиксели очень плохая единица измерения и является плохим тоном,
лучше используй rem и em, ведь они являются условными единицами измерения для браузера, и при адаптивной
вёрстке они очень сильно помогают, ведь браузер плохо понимает пиксели в размере шрифта. А так, используйте пиксели
и не парьтесь, но ждите, ведь настанет момент и всё придутся переписывать на em или rem

> Если что, 1rem = 16px, 1em = 24px, а что там по фракциям, это если что fr, я не знаю

И ещё, пишем всё на флексах, если не умеешь, то иди [сюда](https://webstacker.net/front-end/css/flexbox-samyj-polnyj-gajd-ili-kak-sverstat-sajt-i-ne-umeret/)

## Дизайн-система

> Дизайн-система — вещь очень важная на проекте, чти и почитай её, или сгниёшь в болоте говно кода

### Цвета

```css

:root {
    --primary-bg-color: #27282c;
    --sub-text-color: #83848f;
    --secondary-bg-color: #232526;
    --white: #fff;
    --blue: #0F6FFF;
    --form-text: #63717f;
    --form-bg: #2b303b;
    --dark-blue: #1E6BDD;
    --sub-icon-color: #6F7177;
    --red: #F77069;
}
```

Используйте эти переменные для обозначения цветов, пока-что так,
но скоро у нас появится файлик в figma со всеми объяснениями по
использованию цветов 

Продолжение следует...