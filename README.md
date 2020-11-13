# ViteX FullNode Online Checker

Can be started on any web server with php 7.2+ and no execution timeout restrictions.

v01:
- basic functionality
- preloader
- extreme address validation via vite block explorer (therefore quite slow)
- http response code validation (slow)
- direct API calls while fetching cycles (slow)

v02:
- HTTP validation mechanisms replaced (fast)
- Vite wallet address validation based on vitejs->function isValidAddress($address)
- fetching cycle json data during first query
- storing cycle json data on web server
- cleanup mechanism for cycle json files older than 7 days

#----------------------------------------------------------
TODO in v03:
implement Vite wallet address validation
based on checksum calculation.

Following js functions must be rewritten into PHP:

function getAddrCheckSum(addr: Buffer, isContract? : boolean): Hex {
    const addrPre20 = addr.slice(0, 20);
    const _checkSum = blake2b(addrPre20, null, ADDR_CHECK_SUM_SIZE);
    const checkSum = Buffer.from(_checkSum);

    if (!isContract) {
        return checkSum.toString('hex');
    }

    const newCheckSum = [];
    checkSum.forEach(function (byte) {
        newCheckSum.push(byte ^ 0xFF);
    });

    return Buffer.from(newCheckSum).toString('hex');
}

function getHexAddr(originalAddress: Buffer, checkSum: Hex): Address {
    return ADDR_PRE + originalAddress.slice(0, 20).toString('hex') + checkSum;
}

function isValidHex(hexAddr: Address): Boolean {
    return hexAddr && hexAddr.length === ADDR_LEN && hexAddr.indexOf(ADDR_PRE) === 0;
}

function isValidCheckSum(hexAddr: Address): AddressType {
    const currentChecksum = hexAddr.slice(ADDR_PRE.length + ADDR_SIZE * 2);
    const _addr = hexAddr.slice(ADDR_PRE.length, ADDR_PRE.length + ADDR_SIZE * 2);
    const addr = Buffer.from(_addr, 'hex');

    const contractCheckSum = getAddrCheckSum(addr, true);
    if (contractCheckSum === currentChecksum) {
        return AddressType.Contract;
    }

    const checkSum = getAddrCheckSum(addr);
    if (currentChecksum === checkSum) {
        return AddressType.Account;
    }

    return AddressType.Illegal;
}
