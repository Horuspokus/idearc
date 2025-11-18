const CLOUD_WORDS = [
  { label: '#IDEArc', weight: 26 },
  { label: '#IDEArccomtr', weight: 22 },
  { label: '#autodesk', weight: 18 },
  { label: '#infraworks', weight: 17 },
  { label: '#autocad', weight: 16 },
  { label: '#autocadcivil3d', weight: 20 },
  { label: '#roaddesign', weight: 15 },
  { label: '#roadsandhighways', weight: 14 },
  { label: '#trafficengineering', weight: 13 },
  { label: '#earthworks', weight: 12 },
  { label: '#BIM', weight: 24 }
];

function shuffleWords(words) {
  const items = [...words];

  for (let i = items.length - 1; i > 0; i -= 1) {
    const j = Math.floor(Math.random() * (i + 1));
    [items[i], items[j]] = [items[j], items[i]];
  }

  return items;
}

function createWordElement(word, maxWeight) {
  const span = document.createElement('span');
  const size = 0.95 + (word.weight / maxWeight) * 1.4;
  const tilt = (Math.random() * 6 - 3).toFixed(2);
  const hue = 355 + Math.random() * 10;
  const saturation = 82 + Math.random() * 8;
  const lightness = 60 + Math.random() * 6;

  span.className = 'word-cloud-word';
  span.textContent = word.label;
  span.style.setProperty('--wc-size', `${size.toFixed(2)}rem`);
  span.style.setProperty('--wc-tilt', `${tilt}deg`);
  span.style.background = `linear-gradient(120deg, hsla(${hue}, ${saturation}%, ${lightness}%, 0.08), hsla(${hue}, ${saturation}%, ${lightness}%, 0.02))`;
  span.style.borderColor = `hsla(${hue}, ${saturation}%, ${lightness}%, 0.18)`;
  span.setAttribute('role', 'listitem');
  span.setAttribute('aria-label', word.label);

  return span;
}

function renderWordCloud(container) {
  const maxWeight = Math.max(...CLOUD_WORDS.map((word) => word.weight));
  const shuffled = shuffleWords(CLOUD_WORDS);

  container.innerHTML = '';
  shuffled.forEach((word) => {
    container.appendChild(createWordElement(word, maxWeight));
  });
}

export function initWordCloud() {
  const body = document.body;
  if (!body || body.dataset.page !== 'about') {
    return;
  }

  const container = document.getElementById('aboutWordCloud');
  if (!container) {
    return;
  }

  const shuffleButton = document.querySelector('[data-word-cloud-reshuffle]');
  const refreshCloud = () => renderWordCloud(container);

  refreshCloud();

  if (shuffleButton) {
    shuffleButton.addEventListener('click', refreshCloud);
  }
}
