<?php require '../../model/notifications.model.php'; ?>
<?php //getSaloonsTagFormatUser($idSession); ?>



<a href="#" id="subscribe-link" style="display: none;">NOTIFS💬</a>

<script>
    var OneSignal = OneSignal || [];

    //propose d'accepter les notifs si pas encore fait sur cet appareil
    function subscribe() {
        OneSignal.push(["registerForPushNotifications"]);
        event.preventDefault();
    }
    OneSignal.push(function() {
        // on fait rien si browser pas supported
        if (!OneSignal.isPushNotificationsSupported()) {
          return;
        }
        OneSignal.isPushNotificationsEnabled(function(isEnabled) {
          if (isEnabled) {
            // user inscrit au notifs, on affiche rien
          } else {
            document.getElementById("subscribe-link").addEventListener('click', subscribe);
            document.getElementById("subscribe-link").style.display = '';
          }
        });
    });

    //envoie les tags de l'utilisateur (tags = ses saloons)
    function sendLesTags(){
        OneSignal.push(function() {
          //chaque user a un tag par saloon dans lequel il est.
          OneSignal.sendTags({
            //key1: 'lol',  //on veut se format pour ajouter des tags (on s'en bat des values (= à 'lol'), c'est les keyN qui définissent ds quels saloons est un user (key3 => user est ds saloon de id=3))
            //key2: 'lol',  //getSaloonsTagFormatUser crée se format ac les saloon de l'user
            <?php getSaloonsTagFormatUser($idSession); ?>
          });
        });
    }
    sendLesTags();  //on envoie les tags de l'utilisateur à chaque refresh. pas top, à modifier ac ajax ds le futur.
</script>
