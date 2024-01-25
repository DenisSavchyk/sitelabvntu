<tr>
    <td>{i}</td>
    <td>{name}</td>
    <td>{frags}</td>
    <td>{time}</td>
    {if('{server_rcon}' == '1' && is_auth() && is_worthy_specifically("s", '{server_id}'))}
        <td>
            <button type="button" class="btn btn-default btn-sm" onclick="abort_player(1, '{name_initial}', '{server_id}');">Кик</button>
            <button type="button" class="btn btn-default btn-sm" onclick="abort_player(2, '{name_initial}', '{server_id}');">Бан</button>
        </td>
    {/if}
</tr>