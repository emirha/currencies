<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="MessageSystem">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Emir test for CurrencyFair</title>

    <script type="application/javascript" src="/js/jquery-1.11.2.min.js"></script>
    <script type="application/javascript" src="/js/angular.min.js"></script>
    <script type="application/javascript" src="/js/angular-resource.min.js"></script>
    <script type="application/javascript" src="/js/angular-sanitize.min.js"></script>
    <script type="application/javascript" src="/js/app.js"></script>


    <link href="/stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />

</head>
<body>
<main ng-controller="MessageController as MessageCtrl">

    <div id="tops">
        <section id="topCurrencies">
            <div>
                <h2>Top Sold Currencies</h2>
                <table>
                    <tr>
                        <th>Currency</th>
                        <th>Total</th>
                    </tr>

                    <tr ng-repeat="topSoldCurrency in MessageCtrl.topSold track by $index">
                        <td>{{topSoldCurrency.currency}}</td>
                        <td>{{topSoldCurrency.totalSold}}</td>
                    </tr>
                </table>
            </div>

            <div>
                <h2>Top Bought Currencies</h2>

                <table>
                    <tr>
                        <th>Currency</th>
                        <th>Total</th>
                    </tr>

                    <tr ng-repeat="topBoughtCurrency in MessageCtrl.topBought track by $index">
                        <td>{{topBoughtCurrency.currency}}</td>
                        <td>{{topBoughtCurrency.totalSold}}</td>
                    </tr>
                </table>
            </div>
        </section>

        <section id="topCountries">
            <h2>Top Buying Countries by Amount</h2>

            <table>
                <tr>
                    <th>Country</th>
                    <th>Currency</th>
                    <th>Bought</th>
                    <th>Sold</th>
                </tr>

                <tr ng-repeat="topCountry in MessageCtrl.topCountries track by $index">
                    <td>{{topCountry.country}}</td>
                    <td>{{topCountry.currency}}</td>
                    <td>{{topCountry.totalBought}}</td>
                    <td>{{topCountry.totalSold}}</td>
                </tr>
            </table>

        </section>
    </div>

    <section id="messages" >
        <h2>Last 20 Messages</h2>
        <table>
            <tr>
                <th>User</th>
                <th>From</th>
                <th>To</th>
                <th>Sold</th>
                <th>Bought</th>
                <th>Rate</th>
                <th>Time</th>
                <th>Country</th>
            </tr>
            <tr ng-repeat="message in MessageCtrl.messages track by $index">
                <td>{{message.userId}}</td>
                <td>{{message.currencyFrom}}</td>
                <td>{{message.currencyTo}}</td>
                <td>{{message.amountSell}}</td>
                <td>{{message.amountBuy}}</td>
                <td>{{message.rate}}</td>
                <td>{{message.timePlaced}}</td>
                <td>{{message.originatingCountry}}</td>
            </tr>
        </table>
    </section>

</main>

</body>
</html>