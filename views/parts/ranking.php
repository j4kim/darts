<table class="table">
    <thead>
        <tr>
            <th>Joueur</th>
            <th>Points</th>
            <th>Parties</th>
            <th>Gagnées</th>
            <th>Points par partie</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tournament->participants as $participant) : ?>
            <tr>
                <td><?= $participant->username ?></td>
                <td><?= $participant->score ?></td>
                <td><?= $participant->played ?></td>
                <td><?= $participant->wins ?></td>
                <td><?= $participant->played ? round($participant->score / $participant->played) : '' ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>