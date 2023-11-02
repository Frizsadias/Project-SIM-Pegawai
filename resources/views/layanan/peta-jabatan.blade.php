<html>
  <head>
    <meta charset="UTF-8" />
  </head>

  <body>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-org-chart@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-flextree@2.1.2/build/d3-flextree.js"></script>
    <div
      class="chart-container"
      style="height: 1200px; background-color: #fffeff"
    ></div>

    <script>
      var chart;
      d3.csv(
        'https://raw.githubusercontent.com/bumbeishvili/sample-data/main/org.csv'
      ).then((dataFlattened) => {
        chart = new d3.OrgChart()
          .container('.chart-container')
          .data(dataFlattened)
          .rootMargin(100)
          .nodeWidth((d) => 210)
          .nodeHeight((d) => 140)
          .childrenMargin((d) => 130)
          .compactMarginBetween((d) => 75)
          .compactMarginPair((d) => 80)
          .linkUpdate(function (d, i, arr) {
            d3.select(this)
              .attr('stroke', (d) =>
                d.data._upToTheRootHighlighted ? '#152785' : 'lightgray'
              )
              .attr('stroke-width', (d) =>
                d.data._upToTheRootHighlighted ? 5 : 1.5
              )
              .attr('stroke-dasharray', '4,4');

            if (d.data._upToTheRootHighlighted) {
              d3.select(this).raise();
            }
          })
          .nodeContent(function (d, i, arr, state) {
            const colors = [
              '#6E6B6F',
              '#18A8B6',
              '#F45754',
              '#96C62C',
              '#BD7E16',
              '#802F74',
            ];
            const color = colors[d.depth % colors.length];
            const imageDim = 80;
            const lightCircleDim = 95;
            const outsideCircleDim = 110;

            return `
                <div style="background-color:white; position:absolute;width:${
                  d.width
                }px;height:${d.height}px;">
                   <div style="background-color:${color};position:absolute;margin-top:-${outsideCircleDim / 2}px;margin-left:${d.width / 2 - outsideCircleDim / 2}px;border-radius:100px;width:${outsideCircleDim}px;height:${outsideCircleDim}px;"></div>
                   <div style="background-color:#ffffff;position:absolute;margin-top:-${
                     lightCircleDim / 2
                   }px;margin-left:${d.width / 2 - lightCircleDim / 2}px;border-radius:100px;width:${lightCircleDim}px;height:${lightCircleDim}px;"></div>
                   <img src=" ${
                     d.data.imageUrl
                   }" style="position:absolute;margin-top:-${imageDim / 2}px;margin-left:${d.width / 2 - imageDim / 2}px;border-radius:100px;width:${imageDim}px;height:${imageDim}px;" />
                   <div class="card" style="top:${
                     outsideCircleDim / 2 + 10
                   }px;position:absolute;height:30px;width:${d.width}px;background-color:#3AB6E3;">
                      <div style="background-color:${color};height:28px;text-align:center;padding-top:10px;color:#ffffff;font-weight:bold;font-size:16px">
                          ${d.data.name} 
                      </div>
                      <div style="background-color:#F0EDEF;height:28px;text-align:center;padding-top:10px;color:#424142;font-size:16px">
                          ${d.data.positionName} 
                      </div>
                   </div>
               </div>
  `;
          })
          .render();
      });
    </script>

    <a
      target="_blank"
      href="https://github.com/bumbeishvili/d3-organization-chart"
    >
      <img
        style="position: fixed; top: 0; right: 0; border: 0; z-index: 2"
        width="149"
        height="149"
        src="https://bumbeishvili.github.io/d3-tooltip/forkme.png"
        alt="Fork me on GitHub"
      />
    </a>
  </body>
  <script src="https://storage.ko-fi.com/cdn/scripts/overlay-widget.js"></script>
  <script>
    kofiWidgetOverlay.draw('bumbeishvili', {
      type: 'floating-chat',
      'floating-chat.donateButton.text': 'Tip Us',
      'floating-chat.donateButton.background-color': '#00b9fe',
      'floating-chat.donateButton.text-color': '#fff',
    });
  </script>
</html>
