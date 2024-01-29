<table class="table">
    <thead class="hidden sm:table-header-group">
        <tr>
            <th>Joueur</th>
            <th>Points</th>
            <th>Parties</th>
            <th>Gagnées</th>
            <th>Points par partie</th>
        </tr>
    </thead>
    <thead class="sm:hidden">
        <tr>
            <th>Joueur</th>
            <th>Pts</th>
            <th>P</th>
            <th>G</th>
            <th>p/p</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tournament->participants as $participant) : ?>
            <tr>
                <td><?= $participant->username ?></td>
                <td><?= $participant->score ?></td>
                <td><?= $participant->played ?></td>
                <td><?= $participant->wins ?></td>
                <td><?= round($participant->score_per_game ?? 0) ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>