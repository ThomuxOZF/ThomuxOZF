window.addEventListener('load', init);
window.addEventListener('resize', resize);

var particles = [];
var particleCount = 50;

var body = null;
var context = null;

var palette = ['#F00', '#0F0', '#00F', '#FF0'];

var gradient = null;

function init() {
    body = document.getElementById('animation-surface');
    context = body.getContext('2d');

    for (var i = 0; i < particleCount; i++) {
        var randomColourIndex = Math.round((palette.length - 1) * Math.random());
        var speed = Math.random() * 4;
        var angle = Math.PI * 2 * Math.random();

        var particle = {
            x: body.width * 0.5,
            y: body.height * 0.5,
            vx: Math.cos(angle) - speed,
            vy: Math.sin(angle) - speed,
            radius: 15 * Math.random(),
            colour: palette[randomColourIndex]
        };

        particles.push(particle);
    }

    resize();
    update();
}

function update() {
    context.clearRect(0, 0, body.width, body.height);

    for (var i = 0; i < particleCount; i++) {
        var particle = particles[i];

        particle.vy += 0;

        particle.x += particle.vx;
        particle.y += particle.vy;

        if (particle.y > body.height) {
            particle.y = body.height;
            particle.vy = -particle.vy;
        } else if (particle.y < 0) {
            particle.y = 0;
            particle.vy = -particle.vy;
        }

        if (particle.x > body.width) {
            particle.x = body.width;
            particle.vx = -particle.vx;
        } else if (particle.x < 0) {
            particle.x = 0;
            particle.vx = -particle.vx;
        }

        drawParticle(context, particle);
    }

    context.save();
    context.globalCompositeOperation = 'source-atop';
    context.fillStyle = gradient;
    context.fillRect(0, 0, body.width, body.height);
    context.restore();

    requestAnimationFrame(update);
}

function drawParticle(context, particle) {
    context.fillStyle = particle.colour;
    context.beginPath();
    context.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
    context.closePath();
    context.fill();
}

function resize() {
    body.width = window.innerWidth;
    body.height = window.innerHeight;

    gradient = context.createLinearGradient(0, 0, body.width, body.height);
    gradient.addColorStop(0, 'rgb(240, 211, 247)');
    gradient.addColorStop(1, 'rgb(240, 211, 247)');
}
    
    
